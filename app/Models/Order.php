<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'customer_id',
        'shipping_id',
        'payment_id',
        'order_total',
        'order_status',

    ];

    protected $primaryKey = 'id';
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
