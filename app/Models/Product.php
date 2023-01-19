<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'brand_id',
        'event_id',
        'event_detail_id',
        'product_name',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'meta_keywords',
        'product_status',
    ];

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(BrandProduct::class, 'brand_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function event_detail()
    {
        return $this->belongsTo(EventDetail::class, 'event_detail_id');
    }

    public function galleries()
    {
        return $this->hasMany(GalleryProduct::class);
    }

    public function order_detail()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'like_products', 'user_id', 'product_id');
    }
}
