<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'event_id',
        'event_detail_type',
        'event_detail_discount',
        'event_detail_start',
        'event_detail_end',
        'event_detail_status'
    ];

    protected $primaryKey = 'id';
    protected $table = 'event_details';

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'event_detail_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(BrandProduct::class, 'brand_id');
    }
}
