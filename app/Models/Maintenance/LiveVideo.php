<?php

namespace App\Models\Maintenance;

use App\Models\User;
use App\Traits\Uuids;
use App\Traits\LocalTimestamps;
use App\Models\Maintenance\GameType;
use App\Models\Maintenance\VideoType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiveVideo extends Model
{
    use HasFactory, Uuids, SoftDeletes, LocalTimestamps;
    protected $guarded = [];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'name');
    }
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by')->select('id', 'name');
    }

    public function gameType()
    {
        return $this->belongsTo(GameType::class, 'game_type_id')->select('id', 'code');
    }
    public function videoType()
    {
        return $this->belongsTo(VideoType::class, 'video_type_id')->select('id', 'code');
    }
}
