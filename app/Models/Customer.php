<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackCreatedUpdatedDeletedBy;

class Customer extends Model
{

    use SoftDeletes, TrackCreatedUpdatedDeletedBy;

    protected $fillable = [
        'name',
        'created_by',
    ];
}
