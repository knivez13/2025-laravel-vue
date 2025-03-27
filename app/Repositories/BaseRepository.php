<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Services\ValidationService;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function all(): Collection
    {
        return  DB::transaction(function () {
            return $this->model->all();
        });
    }

    public function find(string $id): ?Model
    {
        return  DB::transaction(function () use ($id) {
            return $this->model->find($id);
        });
    }

    public function create(array $data): Model
    {
        return  DB::transaction(function () use ($data) {
            if (!isset($this->rules)) {
                throw new \Exception("Validation rules not defined in " . get_called_class());
            }
            ValidationService::validate($data, $this->rules);
            $input = Arr::only($data, $this->filteredInsertData);
            if (isset($data['file_path'])) {
                $input['file_path'] = ImageUploadService::upload($data['file_path'], 'upload');
            }
            $input['created_by'] = Auth::user()->id;
            return $this->model->create($input);
        });
    }

    public function update(string $id, array $data): bool
    {
        return  DB::transaction(function () use ($id, $data) {
            if (!isset($this->rules)) {
                throw new \Exception("Validation rules not defined in " . get_called_class());
            }
            ValidationService::validate($data, $this->rules, $id);
            $record = $this->model->find($id);
            $input = Arr::only($data, $this->filteredInsertData);
            if (isset($data['file_path'])) {
                $input['file_path'] = ImageUploadService::upload($data['file_path'], 'upload');
            }
            $input['updated_by'] = Auth::user()->id;
            return $record ? $record->update($input) : false;
        });
    }

    public function delete(string $id): bool
    {
        return  DB::transaction(function () use ($id) {
            $record = $this->model->find($id);
            return $record ? $record->delete() : false;
        });
    }

    public function restore(string $id)
    {
        return  DB::transaction(function () use ($id) {
            $model = $this->model->onlyTrashed()->findOrFail($id);
            return $model->restore(); // 🟢 Restore soft-deleted record
        });
    }

    public function forceDelete(string $id)
    {

        return  DB::transaction(function () use ($id) {
            $model = $this->model->onlyTrashed()->findOrFail($id);
            return $model->forceDelete(); // 🛑 Permanently delete the record
        });
    }

    public function getDeleted(int $perPage = 10)
    {
        return $this->model->onlyTrashed()->paginate($perPage); // 🟢 Retrieve soft-deleted records
    }

    public function paginateWithFilters(array $filters = [], int $perPage = 10, string $sortBy = 'id', string $sortOrder = 'asc'): LengthAwarePaginator
    {
        $query = $this->model->query();

        // 🔎 Word-based searching across multiple fields
        if (!empty($filters['search']) && !empty($this->filterableFields)) {
            $searchTerms = explode(' ', $filters['search']);
            $query->where(function (Builder $q) use ($searchTerms) {
                foreach ($searchTerms as $word) {
                    $q->orWhere(function (Builder $subQuery) use ($word) {
                        foreach ($this->filterableFields as $field) {
                            $subQuery->orWhere($field, 'LIKE', "%$word%");
                        }
                    });
                }
            });
        }

        // 📅 Date range filtering
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // 🏷️ Category filtering
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // 👤 Filter by user (if applicable)


        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['per_page'])) {
            $perPage = $filters['per_page'];
        }
        // 🔀 Sorting
        if (!empty($sortBy) && !empty($sortOrder)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        if (!empty($this->relationshipTable)) {
            $query->with($this->relationshipTable);
        }

        return $query->paginate($perPage);
    }
}
