<?php

namespace App\Traits;

trait LocalTimestamps
{
    public function getCreatedAtAttribute($value)
    {
        // Convert the stored UTC timestamp to your desired timezone
        return $value ? \Carbon\Carbon::parse($value)->format('m/d/Y h:i a') : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        // Convert the stored UTC timestamp to your desired timezone
        return $value ? \Carbon\Carbon::parse($value)->format('m/d/Y h:i a') : null;
    }

    public function getDeletedAtAttribute($value)
    {
        // Convert the stored UTC timestamp to your desired timezone
        return $value ? \Carbon\Carbon::parse($value)->format('m/d/Y h:i a') : null;
    }

    public function setCreatedAtAttribute($value)
    {
        // Convert the incoming datetime to UTC before storing
        $this->attributes['created_at'] = \Carbon\Carbon::parse($value);
    }

    public function setUpdatedAtAttribute($value)
    {
        // Convert the incoming datetime to UTC before storing
        $this->attributes['updated_at'] = \Carbon\Carbon::parse($value);
    }

    public function setDeletedAtAttribute($value)
    {
        // Convert the incoming datetime to UTC before storing
        $this->attributes['deleted_at'] = \Carbon\Carbon::parse($value);
    }
}
