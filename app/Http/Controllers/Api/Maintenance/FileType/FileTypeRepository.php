<?php

namespace App\Http\Controllers\Api\Maintenance\FileType;

use App\Models\Maintenance\FileType;
use App\Repositories\BaseRepository;
use App\Http\Controllers\Api\Maintenance\FileType\FileTypeInterface;

class FileTypeRepository extends BaseRepository implements FileTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:file_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(FileType $model)
    {
        parent::__construct($model);
    }
}
