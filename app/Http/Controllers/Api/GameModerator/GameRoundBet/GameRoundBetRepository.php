<?php

namespace App\Http\Controllers\Api\GameModerator\GameRoundBet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\GameModerator\GameRoundBet;

class GameRoundBetRepository extends BaseRepository implements GameRoundBetInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(GameRoundBet $model)
    {
        parent::__construct($model);
    }
}
