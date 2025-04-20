<?php

namespace App\Http\Controllers\Api\GameModerator\GameListRound;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\GameModerator\GameListRound;

class GameListRoundRepository extends BaseRepository implements GameListRoundInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(GameListRound $model)
    {
        parent::__construct($model);
    }
}
