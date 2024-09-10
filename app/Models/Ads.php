<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'avatar', 'name', 'description', 'status', 'is_home'];

    protected $attributes = ['slug' => ''];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->slug = $data->generateSlug($data->name);
            $data->save();
        });
    }

    private function generateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::where('name', $name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function updateAvatar($request)
    {
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($this->avatar && File::exists($this->avatar)) {
                File::delete($this->avatar);
            }

            // Store new avatar
            $file = $request->file('avatar');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('images', $file_name);
            $this->avatar = 'images/' . $file_name;

            // Save model
            $this->save();
        }
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) {
            return asset($this->avatar);
        } else {
            return 'assets/media/svg/files/blank-image.svg';
        }
    }

    public function scopeIsHome($query)
    {
        return $query->where('is_home', 1);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }
}
