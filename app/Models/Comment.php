<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'rate',
        'comment',
    ];

    protected $primaryKey = 'id';
    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
