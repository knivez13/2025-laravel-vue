<?php

namespace App\Http\Controllers\Api\Maintenance\GamePresent;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\GamePresent;

class GamePresentRepository extends BaseRepository implements GamePresentInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(GamePresent $model)
    {
        parent::__construct($model);
    }
}
