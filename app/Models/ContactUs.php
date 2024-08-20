<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'f_name',
        'l_name',
        'message',
        'subject'
    ];

    protected $attributes = ['slug' => ''];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->slug = $data->generateSlug($data->f_name);
            $data->save();
        });
    }
    private function generateSlug($data)
    {
        if (static::whereSlug($slug = Str::slug($data))->exists()) {
            $max = static::where('f_name', $data)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
