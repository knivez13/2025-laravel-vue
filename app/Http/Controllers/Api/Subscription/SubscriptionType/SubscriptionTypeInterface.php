<?php

namespace App\Http\Controllers\Api\Subscription\SubscriptionType;

use App\Repositories\BaseRepositoryInterface;

interface SubscriptionTypeInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
