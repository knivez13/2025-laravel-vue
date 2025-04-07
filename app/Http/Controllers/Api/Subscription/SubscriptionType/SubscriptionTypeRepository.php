<?php

namespace App\Http\Controllers\Api\Subscription\SubscriptionType;

use App\Repositories\BaseRepository;
use App\Services\ImageUploadService;
use App\Models\Subscription\SubscriptionType;

class SubscriptionTypeRepository extends BaseRepository implements SubscriptionTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:subscription_types,code'],
        'description' => ['required', 'string'],
        'order' => ['required', 'string'],
        'list_count' => ['required', 'integer'],
        'boost_count' => ['required', 'integer'],
        'sell_count' => ['required', 'integer'],
        'day_package' => ['required', 'integer'],
        'price' => ['required', 'decimal'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description', 'order', 'discount', 'boost_count', 'list_count', 'sell_count', 'day_package', 'price'];

    public function __construct(SubscriptionType $model)
    {
        parent::__construct($model);
    }
    public function preprocessBeforeStore(array $data): array
    {
        if (isset($data['file_path'])) {
            $input['file_path'] = ImageUploadService::upload($data['file_path'], 'upload');
        }
        // Add or modify data before storing
        $data['created_by'] = auth()->id(); // Add the ID of the authenticated user
        $data['created_at'] = now(); // Add the current timestamp
        return $data;
    }

    public function preprocessBeforeUpdate(int $id, array $data): array
    {
        // Add or modify data before updating
        $data['updated_by'] = auth()->id(); // Add the ID of the authenticated user
        $data['updated_at'] = now(); // Add the current timestamp
        return $data;
    }
}
