<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'event_name',
        'event_desc',
        'event_content',
        'event_image',
        'event_start',
        'event_end',
        'event_status'
    ];

    protected $primaryKey = 'id';
    protected $table = 'events';

    public function products()
    {
        return $this->hasMany(Product::class, 'event_id');
    }

    public function event_details()
    {
        return $this->hasMany(EventDetail::class, 'event_id');
    }
}
