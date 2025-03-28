<?php

namespace App\Http\Controllers\Api\Maintenance\PropCategory;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\PropCategory;
use App\Http\Controllers\Api\Maintenance\PropCategory\PropCategoryInterface;

class PropCategoryRepository extends BaseRepository implements PropCategoryInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:prop_categories,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropCategory $model)
    {
        parent::__construct($model);
    }
}
