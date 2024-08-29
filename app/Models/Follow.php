<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'follower_id', 'following_id'];

    protected $attributes = ['follower_id' => 1];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->follower_id = auth()->user()->id;
            $data->save();
        });
    }
}
