<?php

namespace App\Http\Controllers\Api\Maintenance\PropListType;

use App\Repositories\BaseRepositoryInterface;

interface PropListTypeInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
