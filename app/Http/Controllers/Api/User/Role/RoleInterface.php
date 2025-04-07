<?php

namespace App\Http\Controllers\Api\User\Role;

use App\Repositories\BaseRepositoryInterface;

interface RoleInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
