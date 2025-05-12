<?php

namespace App\Http\Controllers\Api\GameModerator\GameRoundOds;

use App\Repositories\BaseRepository;
use App\Models\GameModerator\GameRoundOds;

class GameRoundOdsRepository extends BaseRepository implements GameRoundOdsInterface
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

    public function __construct(GameRoundOds $model)
    {
        parent::__construct($model);
    }
}
