<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'agency_id', 'type', 'asset', 'amount', 'dollar'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
