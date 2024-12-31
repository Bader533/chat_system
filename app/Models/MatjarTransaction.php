<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatjarTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matjar_product_id',
        'transaction_type',
        'points',
        'transaction_date'
    ];

    public function product()
    {
        return $this->belongsTo(MatjarProduct::class, 'matjar_product_id');
    }
}
