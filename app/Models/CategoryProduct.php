<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'category_name',
        'category_desc',
        'category_image',
        'meta_keywords',
        'category_status'
    ];

    protected $table = 'category_products';

    public function brands()
    {
        return $this->hasMany(BrandProduct::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function event_detail()
    {
        return $this->hasOne(EventDetail::class);
    }
}
