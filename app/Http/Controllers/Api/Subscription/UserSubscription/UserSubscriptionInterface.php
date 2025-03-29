<?php

namespace App\Http\Controllers\Api\Subscription\UserSubscription;

use App\Repositories\BaseRepositoryInterface;

interface UserSubscriptionInterface extends BaseRepositoryInterface
{
    public function preprocessBeforeStore(array $data): array;
    public function preprocessBeforeUpdate(int $id, array $data): array;
}
