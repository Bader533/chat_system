<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gift_id',
        'transaction_type',
        'points',
        'transaction_date'
    ];

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }
}
