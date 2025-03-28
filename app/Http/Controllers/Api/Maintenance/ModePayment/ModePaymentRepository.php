<?php

namespace App\Http\Controllers\Api\Maintenance\ModePayment;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\ModePayment;
use App\Http\Controllers\Api\Maintenance\ModePayment\ModePaymentInterface;

class ModePaymentRepository extends BaseRepository implements ModePaymentInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:mode_payments,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(ModePayment $model)
    {
        parent::__construct($model);
    }
}
