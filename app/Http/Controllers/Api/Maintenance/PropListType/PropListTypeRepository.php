<?php

namespace App\Http\Controllers\Api\Maintenance\PropListType;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\PropListType;
use App\Http\Controllers\Api\Maintenance\PropListType\PropListTypeInterface;

class PropListTypeRepository extends BaseRepository implements PropListTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:prop_list_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropListType $model)
    {
        parent::__construct($model);
    }
}
