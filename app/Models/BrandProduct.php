<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'category_id',
        'brand_name',
        'brand_desc',
        'meta_keywords',
        'brand_status',
    ];


    protected $table = 'brand_products';

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function event_detail()
    {
        return $this->hasOne(EventDetail::class);
    }
}
