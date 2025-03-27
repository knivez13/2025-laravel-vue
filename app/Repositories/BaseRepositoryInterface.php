<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface BaseRepositoryInterface
{
    public function all(): Collection;
    public function find(string $id): ?Model;
    public function create(array $data): Model;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
    public function restore(string $id);
    public function forceDelete(string $id);
    public function getDeleted(int $perPage = 10);
    public function paginateWithFilters(array $filters = [], int $perPage = 10, string $sortBy = 'id', string $sortOrder = 'asc'): LengthAwarePaginator;
}
