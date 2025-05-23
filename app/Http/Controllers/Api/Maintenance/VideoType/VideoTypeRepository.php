<?php

namespace App\Http\Controllers\Api\Maintenance\VideoType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\VideoType;

class VideoTypeRepository extends BaseRepository implements VideoTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:video_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'video_type';

    public function __construct(VideoType $model)
    {
        parent::__construct($model);
    }
}
