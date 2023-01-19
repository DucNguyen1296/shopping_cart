<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'delivery_fee',
        'city_code',
        'province_code',
        'ward_code'
    ];

    protected $primaryKey = 'id';
    protected $table = 'deliveries';

    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'city_code');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'province_code');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_code', 'ward_code');
    }

    public function order_detail_delivery()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
