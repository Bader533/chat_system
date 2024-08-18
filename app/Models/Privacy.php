<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'description'];

    protected $attributes = ['slug' => ''];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($privacy) {
            $privacy->slug = $privacy->generateSlug($privacy->title);
            $privacy->save();
        });
    }
    private function generateSlug($title)
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::where('title', $title)->latest('id')->skip(1)->value('slug');
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
