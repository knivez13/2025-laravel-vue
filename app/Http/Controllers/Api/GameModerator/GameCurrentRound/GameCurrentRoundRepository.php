<?php

namespace App\Http\Controllers\Api\GameModerator\GameCurrentRound;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\GameModerator\GameCurrentRound;

class GameCurrentRoundRepository extends BaseRepository implements GameCurrentRoundInterface
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

    public function __construct(GameCurrentRound $model)
    {
        parent::__construct($model);
    }
}
