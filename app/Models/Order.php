<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\TrackUser;
use App\Models\Customer;

class Order extends Model
{

    use SoftDeletes, TrackUser;

    protected $fillable = [
        'customer_id',
        'total_amount',
        'discount',
        'grand_total',
        'created_by',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
