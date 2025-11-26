<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by'
    ];


    // relationship with user
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
