<?php

namespace App\Http\Controllers\Api\Maintenance\GameProvider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\GameProvider;

class GameProviderRepository extends BaseRepository implements GameProviderInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:game_providers,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'game_provider';

    public function __construct(GameProvider $model)
    {
        parent::__construct($model);
    }
}
