<?php

namespace App\Http\Controllers\Api\Maintenance\Appliances;

use App\Repositories\BaseRepositoryInterface;

interface AppliancesInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
