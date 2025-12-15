<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackCreatedUpdatedDeletedBy;

class Product extends Model
{
    use SoftDeletes, TrackCreatedUpdatedDeletedBy;

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
