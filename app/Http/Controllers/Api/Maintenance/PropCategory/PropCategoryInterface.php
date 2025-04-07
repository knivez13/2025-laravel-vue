<?php

namespace App\Http\Controllers\Api\Maintenance\PropCategory;

use App\Repositories\BaseRepositoryInterface;

interface PropCategoryInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
