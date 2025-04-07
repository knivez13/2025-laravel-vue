<?php

namespace App\Http\Controllers\Api\Maintenance\PropType;

use App\Repositories\BaseRepositoryInterface;

interface PropTypeInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
