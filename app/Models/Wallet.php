<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'diamonds', 'gold', 'silver'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeSearchUser($query, $data)
    {
        return $query->whereHas('user', function ($q) use ($data) {
            $q->where('name', 'like', '%' . $data . '%');
        });
    }

    // public function scopeSearchAgency($query, $data)
    // {
    //     return $query->whereHas('agency', function ($q) use ($data) {
    //         $q->where('name', 'like', '%' . $data . '%');
    //     });
    // }
}
