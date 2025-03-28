<?php

namespace App\Http\Controllers\Api\Maintenance\Appliances;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\Appliances;
use App\Http\Controllers\Api\Maintenance\Appliances\AppliancesInterface;

class AppliancesRepository extends BaseRepository implements AppliancesInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:appliances,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(Appliances $model)
    {
        parent::__construct($model);
    }
}
