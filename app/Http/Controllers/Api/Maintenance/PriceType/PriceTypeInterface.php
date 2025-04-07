<?php

namespace App\Http\Controllers\Api\Maintenance\PriceType;

use App\Repositories\BaseRepositoryInterface;

interface PriceTypeInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
