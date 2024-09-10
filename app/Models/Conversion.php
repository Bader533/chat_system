<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'type', 'quantity', 'dollar', 'status'];

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }
}
