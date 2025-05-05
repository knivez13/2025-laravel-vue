<?php

namespace App\Http\Controllers\Api\Maintenance\LiveVideo;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\LiveVideo;

class LiveVideoRepository extends BaseRepository implements LiveVideoInterface
{
    protected array $rules = [
        'game_type_id' => ['required'],
        'video_type_id' => ['required'],
        'video_name' => ['string'],
        'video_code' => ['string'],
        'app_name' => ['string'],
        'stream_key' => ['string'],
        'url' => ['string'],
        'server_ip' => ['string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['game_type_id', 'video_type_id', 'video_name', 'video_code', 'app_name', 'stream_key', 'url', 'server_ip'];

    public function __construct(LiveVideo $model)
    {
        parent::__construct($model);
    }
}
