<?php

namespace App\Http\Controllers\Api\PaymentGateway\Paymongo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepositoryInterface;

interface PaymongoInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
