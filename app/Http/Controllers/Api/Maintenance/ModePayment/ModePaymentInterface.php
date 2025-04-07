<?php

namespace App\Http\Controllers\Api\Maintenance\ModePayment;

use App\Repositories\BaseRepositoryInterface;

interface ModePaymentInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
