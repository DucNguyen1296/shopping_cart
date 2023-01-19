<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'province_code',
        'province_name',
        'province_type',
        'city_code'
    ];

    protected $primaryKey = 'id';
    protected $table = 'provinces';
}
