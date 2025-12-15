<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackUser;

class Customer extends Model
{

    use SoftDeletes, TrackUser;

    protected $fillable = [
        'name',
        'created_by',
    ];
}
