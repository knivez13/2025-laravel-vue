<?php

namespace App\Http\Controllers\Api\GameModerator\GameList;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\GameModerator\GameList;
use App\Models\GameModerator\GameListRound;

class GameListRepository extends BaseRepository implements GameListInterface
{
    protected array $rules = [
        'game_present_id' => ['required', 'string'],
        'game_name' => ['required', 'string'],
        'event_name' => ['required', 'string'],
        'total_round' => ['required', 'numeric'],
        'multiplier' => ['required', 'numeric'],
        'rate' => ['required', 'numeric'],
        'padding' => ['required', 'numeric'],
    ];

    protected array $filterableFields = ['game_name', 'event_name']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy', 'gamePresent'];
    protected array $filteredInsertData = ['game_present_id', 'game_name', 'event_name', 'total_round', 'multiplier', 'rate', 'padding'];
    protected bool $cacheData = false;
    protected string $cacheName = 'game_list';

    public function __construct(GameList $model)
    {
        parent::__construct($model);
    }


    public function createRound(string $id, int $round): bool
    {
        return DB::transaction(function () use ($id, $round) {
            $user = Auth::user();
            for ($i = 1; $i <= $round; $i += 1) {
                GameListRound::create([
                    'game_list_id' => $id,
                    'round_no' => $i,
                    'created_by' => $user->id,
                ]);
            }
            return true;
        });
    }
}
