<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by'
    ];

    // add data to column
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->created_by = Auth::id();
        });

        static::updating(function ($category) {
            $category->updated_by = Auth::id();
        });

        static::deleting(function ($category) {
            $category->deleted_by = Auth::id();
            $category->save();
        });
    }

    // relationship with user
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
