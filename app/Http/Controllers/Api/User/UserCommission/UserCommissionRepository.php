<?php

namespace App\Http\Controllers\Api\User\UserCommission;

use Illuminate\Http\Request;
use App\Models\User\UserCommission;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

class UserCommissionRepository extends BaseRepository implements UserCommissionInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = false;
    protected string $cacheName = 'video_type';

    public function __construct(UserCommission $model)
    {
        parent::__construct($model);
    }
}
