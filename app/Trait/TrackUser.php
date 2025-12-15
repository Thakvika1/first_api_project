<?php

namespace App\Trait;

use Illuminate\Support\Facades\Auth;

trait TrackUser
{
    protected static function bootTrackUser()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->saveQuietly();
        });
    }
}
