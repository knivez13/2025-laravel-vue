<?php

namespace App\Http\Controllers\Api\Maintenance\Utility;

use App\Repositories\BaseRepositoryInterface;

interface UtilityInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
