<?php

namespace App\Http\Controllers\Api\Subscription\UserSubscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Subscription\UserSubscription;

class UserSubscriptionRepository extends BaseRepository implements UserSubscriptionInterface
{
    protected array $rules = [
        'subscription_type_id' => ['required'],
        'user_id' => ['required'],
    ];

    protected array $filterableFields = ['user_id', 'subscription_type_id']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['user_id', 'subscription_type_id'];

    public function __construct(UserSubscription $model)
    {
        parent::__construct($model);
    }
}
