<?php

namespace App\Http\Controllers\Api\Maintenance\NearLocationFilter;

use App\Repositories\BaseRepositoryInterface;

interface NearLocationFilterInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
