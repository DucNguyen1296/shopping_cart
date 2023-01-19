<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_quantity',
        'coupon_id',
        'delivery_id'
    ];

    protected $primaryKey = 'id';
    protected $table = 'order_details';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }
}
