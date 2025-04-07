<?php

namespace App\Http\Controllers\Api\User\UserList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepositoryInterface;

interface UserListInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
