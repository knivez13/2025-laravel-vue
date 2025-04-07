<?php

namespace App\Http\Controllers\Api\Maintenance\FileType;

use App\Repositories\BaseRepositoryInterface;

interface FileTypeInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
