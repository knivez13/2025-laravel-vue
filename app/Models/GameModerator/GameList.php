<?php

namespace App\Models\GameModerator;

use App\Models\User;
use App\Traits\Uuids;
use App\Traits\LocalTimestamps;
use App\Models\Maintenance\GamePresent;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance\GamePresentOption;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameList extends Model
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

    public function gamePresent()
    {
        return $this->belongsTo(GamePresent::class, 'game_present_id')->select('id', 'code');
    }
    public function gameOption()
    {
        return $this->hasMany(GamePresentOption::class,);
    }
}
