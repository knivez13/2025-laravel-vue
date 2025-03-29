<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\ValidationService;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;
    protected array $rules = [];
    protected array $filterableFields = [];
    protected array $relationshipTable = [];
    protected array $filteredInsertData = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all records.
     */
    public function all(): Collection
    {
        return DB::transaction(fn() => $this->model->all());
    }

    /**
     * Find a record by ID.
     */
    public function find(string $id): ?Model
    {
        return DB::transaction(fn() => $this->model->find($id));
    }

    /**
     * Create a new record.
     */
    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $this->validateData($data);
            $input = $this->prepareDataForInsert($data);
            return $this->model->create($input);
        });
    }

    /**
     * Update an existing record by ID.
     */
    public function update(string $id, array $data): bool
    {
        return DB::transaction(function () use ($id, $data) {
            $this->validateData($data, $id);
            $record = $this->model->find($id);
            if (!$record) {
                return false;
            }
            $input = $this->prepareDataForInsert($data, false);
            return $record->update($input);
        });
    }

    /**
     * Delete a record by ID.
     */
    public function delete(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $record = $this->model->find($id);
            return $record ? $record->delete() : false;
        });
    }

    /**
     * Restore a soft-deleted record by ID.
     */
    public function restore(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $record = $this->model->onlyTrashed()->findOrFail($id);
            return $record->restore();
        });
    }

    /**
     * Permanently delete a soft-deleted record by ID.
     */
    public function forceDelete(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $record = $this->model->onlyTrashed()->findOrFail($id);
            return $record->forceDelete();
        });
    }

    /**
     * Retrieve soft-deleted records with pagination.
     */
    public function getDeleted(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()->paginate($perPage);
    }

    /**
     * Paginate records with filters, sorting, and relationships.
     */
    public function paginateWithFilters(array $filters = [], int $perPage = 10, string $sortBy = 'id', string $sortOrder = 'asc'): LengthAwarePaginator
    {
        $query = $this->model->query();

        // Apply search filters
        if (!empty($filters['search']) && !empty($this->filterableFields)) {
            $this->applySearchFilter($query, $filters['search']);
        }

        // Apply date range filters
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // Apply additional filters
        foreach (['category_id', 'user_id'] as $field) {
            if (!empty($filters[$field])) {
                $query->where($field, $filters[$field]);
            }
        }

        // Apply sorting
        if (!empty($sortBy) && !empty($sortOrder)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Load relationships
        if (!empty($this->relationshipTable)) {
            $query->with($this->relationshipTable);
        }

        return $query->paginate($filters['per_page'] ?? $perPage);
    }

    /**
     * Validate data using the defined rules.
     */
    protected function validateData(array $data, ?string $id = null): void
    {
        if (empty($this->rules)) {
            throw new \Exception("Validation rules not defined in " . get_called_class());
        }
        ValidationService::validate($data, $this->rules, $id);
    }

    /**
     * Prepare data for insertion or update.
     */
    protected function prepareDataForInsert(array $data, bool $isNew = true): array
    {
        $input = Arr::only($data, $this->filteredInsertData);
        $input[$isNew ? 'created_by' : 'updated_by'] = Auth::id();
        return $input;
    }

    /**
     * Apply search filters to the query.
     */
    protected function applySearchFilter(Builder $query, string $search): void
    {
        $searchTerms = explode(' ', $search);
        $query->where(function (Builder $q) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $q->orWhere(function (Builder $subQuery) use ($term) {
                    foreach ($this->filterableFields as $field) {
                        $subQuery->orWhere($field, 'LIKE', "%$term%");
                    }
                });
            }
        });
    }
}
