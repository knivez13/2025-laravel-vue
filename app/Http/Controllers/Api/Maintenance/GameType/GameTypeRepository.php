<?php

namespace App\Http\Controllers\Api\Maintenance\GameType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Maintenance\GameType;
use App\Repositories\BaseRepository;

class GameTypeRepository extends BaseRepository implements GameTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:game_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'game_types';

    public function __construct(GameType $model)
    {
        parent::__construct($model);
    }
}
