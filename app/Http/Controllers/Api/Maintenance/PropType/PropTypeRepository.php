<?php

namespace App\Http\Controllers\Api\Maintenance\PropType;

use App\Models\Maintenance\PropType;
use App\Repositories\BaseRepository;

class PropTypeRepository extends BaseRepository implements PropTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:prop_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropType $model)
    {
        parent::__construct($model);
    }
}
