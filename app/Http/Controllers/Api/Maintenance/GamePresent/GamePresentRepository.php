<?php

namespace App\Http\Controllers\Api\Maintenance\GamePresent;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\GamePresent;

class GamePresentRepository extends BaseRepository implements GamePresentInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:game_presents,code'],
        'description' => ['required', 'string'],
        'min_bet' => ['required', 'numeric'],
        'max_bet' => ['required', 'numeric'],
        'max_total_bet' => ['required', 'numeric'],
        'bet_opt_winner' => ['required', 'numeric'],
        'game_type_id' => ['required', 'string'],
        'live_one_id' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description', 'min_bet', 'max_bet', 'max_total_bet', 'bet_opt_winner', 'game_type_id', 'game_provider_id', 'live_one_id', 'live_two_id', 'live_three_id'];
    protected bool $cacheData = true;
    protected string $cacheName = 'game_present';

    public function __construct(GamePresent $model)
    {
        parent::__construct($model);
    }
}
