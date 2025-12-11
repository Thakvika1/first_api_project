<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->created_by = Auth::id();
        });

        static::updating(function ($customer) {
            $customer->updated_by = Auth::id();
        });

        static::deleting(function ($customer) {
            $customer->deleted_by = Auth::id();
            $customer->save();
        });
    }
}
