<?php

namespace App\Http\Controllers\Api\Maintenance\NearLocationFilter;

use Illuminate\Http\Request;
use App\Models\Maintenance\Amenity;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;


class NearLocationFilterRepository extends BaseRepository implements NearLocationFilterInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:near_location_filters,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(Amenity $model)
    {
        parent::__construct($model);
    }
}
