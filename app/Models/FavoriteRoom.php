<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteRoom extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id'];

    protected $attributes = ['user_id' => 1];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->user_id = auth()->user()->id;
            $data->save();
        });
    }
}
