<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [

        'ward_code',
        'ward_name',
        'ward_type',
        'province_code'
    ];

    protected $primaryKey = 'id';
    protected $table = 'wards';
}
