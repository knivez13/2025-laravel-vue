<?php

namespace App\Http\Controllers\Api\User\UserList;

use App\Models\User;
use App\Repositories\BaseRepository;


class UserListRepository extends BaseRepository implements UserListInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:video_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'video_type';

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
