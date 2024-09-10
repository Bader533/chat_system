<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percentage extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'percentage', 'status'];

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    
}
