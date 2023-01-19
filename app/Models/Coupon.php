<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'coupon_name',
        'coupon_code',
        'coupon_times',
        'coupon_condition',
        'coupon_numbers',
        'coupon_status'
    ];

    protected $primaryKey = 'id';
    protected $table = 'coupons';

    public function order_detail_coupon()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
