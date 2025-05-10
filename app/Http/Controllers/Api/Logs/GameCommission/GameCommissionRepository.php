<?php

namespace App\Http\Controllers\Api\Logs\GameCommission;

use Illuminate\Http\Request;
use App\Models\Logs\GameCommission;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

class GameCommissionRepository extends BaseRepository implements GameCommissionInterface
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

    public function __construct(GameCommission $model)
    {
        parent::__construct($model);
    }
}
