<?php

namespace App\Http\Controllers\Api\Maintenance\GamePresentOption;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\GamePresentOption;

class GamePresentOptionRepository extends BaseRepository implements GamePresentOptionInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'game_present_option';

    public function __construct(GamePresentOption $model)
    {
        parent::__construct($model);
    }
}
