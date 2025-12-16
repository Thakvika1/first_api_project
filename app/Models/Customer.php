<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackUser;
use App\Models\Order;

class Customer extends Model
{

    use SoftDeletes, TrackUser;

    protected $fillable = [
        'name',
        'created_by',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customers_id', 'id');
    }
}
