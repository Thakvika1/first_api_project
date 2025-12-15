<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackUser;

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
}
