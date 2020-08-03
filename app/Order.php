<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_SUBMITTED = 0;
    const STATUS_SHIPPED = 1;
    const STATUS_DELIVERED = 2;
    const STATUS_CANCELLED = 3;

    public $timestamps = false;
    protected $fillable = ['user_id', 'total_price', 'status', 'order_date'];
}
