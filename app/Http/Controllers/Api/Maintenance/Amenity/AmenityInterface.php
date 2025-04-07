<?php

namespace App\Http\Controllers\Api\Maintenance\Amenity;

use App\Repositories\BaseRepositoryInterface;

interface AmenityInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
