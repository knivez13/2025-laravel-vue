<?php

namespace App\Http\Controllers\Api\PaymentGateway\Paymongo;

use Illuminate\Http\Request;
use App\Models\Maintenance\Amenity;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

class PaymongoRepository extends BaseRepository implements PaymongoInterface
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
