<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryProduct extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'product_id',
        'gallery_name',
        'gallery_image',
    ];

    protected $primaryKey = 'id';
    protected $table = 'gallery_products';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
