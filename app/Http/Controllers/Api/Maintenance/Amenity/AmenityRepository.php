<?php

namespace App\Http\Controllers\Api\Maintenance\Amenity;

use App\Models\Maintenance\Amenity;
use App\Repositories\BaseRepository;
use App\Http\Controllers\Api\Maintenance\Amenity\AmenityInterface;

class AmenityRepository extends BaseRepository implements AmenityInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
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
