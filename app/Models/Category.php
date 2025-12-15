<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Trait\TrackUser;
use App\Models\Product;

class Category extends Model
{
    use SoftDeletes, TrackUser;

    protected $fillable = [
        'name',
        'created_by'
    ];

    // relationship with user
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // relationship with product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
