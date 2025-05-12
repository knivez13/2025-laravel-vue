<?php

namespace App\Http\Controllers\Api\Maintenance\GamePresentAnnouncement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\GamePresentAnnouncement;

class GamePresentAnnouncementRepository extends BaseRepository implements GamePresentAnnouncementInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'game_present_announcement';

    public function __construct(GamePresentAnnouncement $model)
    {
        parent::__construct($model);
    }
}
