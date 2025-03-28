<?php

namespace App\Http\Controllers\Api\Property\SaveProperty;

use App\Repositories\BaseRepository;
use App\Models\Property\PropertySave;

class SavePropertyRepository extends BaseRepository implements SavePropertyInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropertySave $model)
    {
        parent::__construct($model);
    }
}
