<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGift extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'gift_id',
        'status',
        'message',
        'sent_at',
        'received_at'
    ];

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }
}
