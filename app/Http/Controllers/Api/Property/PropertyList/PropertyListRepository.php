<?php

namespace App\Http\Controllers\Api\Property\PropertyList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Property\PropertyList;


class PropertyListRepository extends BaseRepository implements PropertyListInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropertyList $model)
    {
        parent::__construct($model);
    }
}
