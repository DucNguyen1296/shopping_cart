<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [

        'city_code',
        'city_name',
        'city_type'
    ];

    protected $primaryKey = 'id';
    protected $table = 'cities';
}
