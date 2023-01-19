<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
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
        'shipping_name',
        'shipping_email',
        'shipping_address',
        'shipping_phone',
        'shipping_note',

    ];

    protected $primaryKey = 'id';
    protected $table = 'shippings';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
