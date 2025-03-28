<?php

namespace App\Http\Controllers\Api\Maintenance\Utility;

use App\Models\Maintenance\Utility;
use App\Repositories\BaseRepository;

class UtilityRepository extends BaseRepository implements UtilityInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:utilities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(Utility $model)
    {
        parent::__construct($model);
    }
}
