<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matjar_product_id',
        'status',
        'message',
        'sent_at',
        'received_at'
    ];

    // public function product()
    // {
    //     return $this->belongsTo(MatjarProduct::class);
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
