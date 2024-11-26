<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'avatar',
        'status',
    ];

    protected $attributes = ['slug' => ''];

    protected $appends = ['avatar_url'];

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

    /**
     * store and update avatar
     */
    public function updateAvatar($request)
    {
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($this->avatar && Storage::exists($this->avatar)) {
                Storage::delete($this->avatar);
            }

            // Store new avatar
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Store file in the 'public/avatars' directory
            $path = $file->storeAs('avatars', $fileName, 'public');

            $this->avatar = $path;

            // Save model
            $this->save();
        }
    }

    /**
     * get roomtype avatar
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) {
            return asset('storage/' . $this->avatar);
        } else {
            return 'assets/media/svg/files/blank-image.svg';
        }
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
