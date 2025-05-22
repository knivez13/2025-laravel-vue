<?php

namespace App\Models\GameModerator;

use App\Models\User;
use App\Traits\Uuids;
use App\Traits\LocalTimestamps;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance\GamePresentOption;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameRoundBet extends Model
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
    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function gameOption()
    {
        return $this->belongsTo(GamePresentOption::class, 'bet_option_id')->select('id', 'code')->orderBy('order_list', 'asc');
    }
}
