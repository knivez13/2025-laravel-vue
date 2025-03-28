<?php

namespace App\Http\Controllers\Api\Chat\PropertyChat;

use App\Models\Chat\ChatRoom;
use App\Repositories\BaseRepository;


class PropertyChatRepository extends BaseRepository implements PropertyChatInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(ChatRoom $model)
    {
        parent::__construct($model);
    }
}
