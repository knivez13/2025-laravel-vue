<?php

namespace App\Http\Controllers\Api\Chat\PropertyMessage;

use App\Models\Chat\ChatMessage;
use App\Repositories\BaseRepository;

class PropertyMessageRepository extends BaseRepository implements PropertyMessageInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(ChatMessage $model)
    {
        parent::__construct($model);
    }
}
