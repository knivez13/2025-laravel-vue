<?php

namespace App\Http\Controllers\Api\Maintenance\LiveVideo;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\LiveVideo;

class LiveVideoRepository extends BaseRepository implements LiveVideoInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(LiveVideo $model)
    {
        parent::__construct($model);
    }
}
