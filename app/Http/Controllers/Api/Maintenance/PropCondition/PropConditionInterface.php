<?php

namespace App\Http\Controllers\Api\Maintenance\PropCondition;

use App\Repositories\BaseRepositoryInterface;

interface PropConditionInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
