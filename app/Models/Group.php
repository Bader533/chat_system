<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description', 'user_id', 'avatar', 'status'];


    protected $attributes = ['slug' => '', 'user_id' => null];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->user_id = auth()->user()->id;
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

    /**
     * scope to filter groups based on user_id
     */
    public function scopeForCurrentUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    /**
     * scope to filter gruops based on status
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
