<?php

namespace App\Http\Controllers\Api\Maintenance\PropStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\PropStatus;

class PropStatusRepository extends BaseRepository implements PropStatusInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:prop_statuses,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropStatus $model)
    {
        parent::__construct($model);
    }
}
