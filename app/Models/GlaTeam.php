<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GlaTeam extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'status', 'avatar', 'slug'];

    protected $attributes = ['slug' => ''];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->slug = $data->generateSlug($data->title_en);
            $data->save();
        });
    }

    private function generateSlug($title)
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::where('title_en', $title)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }
}
