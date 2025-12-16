<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackUser;

class OrderDetail extends Model
{
    use SoftDeletes, TrackUser;
    
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'total',
        'created_by',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }


}
