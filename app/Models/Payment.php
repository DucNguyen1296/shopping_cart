<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'payment_method',
        'payment_status',

    ];

    protected $primaryKey = 'id';
    protected $table = 'payments';

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
