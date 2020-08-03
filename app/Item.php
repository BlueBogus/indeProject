<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    const STATUS_IN_CART = 0;
    const STATUS_ORDERED = 1;

    public $timestamps = false;
    protected $fillable = ['user_id', 'product_id', 'item_id', 'status'];

    public function user() {
        return $this->belongsToMany(User::class);
    }
}
