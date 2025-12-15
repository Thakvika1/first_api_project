<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackUser;
use App\Models\Category;

class Product extends Model
{
    use SoftDeletes, TrackUser;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'qty',
        'description',
        'image',
        'created_by',
    ];

    // relationship with category
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
