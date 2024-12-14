<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Room extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'avatar', 'name', 'description', 'user_id', 'country_id', 'is_home', 'is_favorite', 'city_id', 'room_type_id', 'status'];

    protected $attributes = ['slug' => '', 'user_id' => null];

    protected $appends = ['avatar_url'];

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
            // حذف الصورة القديمة إذا كانت موجودة
            if ($this->avatar && File::exists(public_path($this->avatar))) {
                File::delete(public_path($this->avatar));
            }

            // التحقق من وجود المجلد "images"
            $destinationPath = public_path('images');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // تخزين الصورة الجديدة
            $file = $request->file('avatar');
            $file_name = time() . '.' . $file->getClientOriginalExtension();

            try {
                $file->move($destinationPath, $file_name);
                $this->avatar = 'images/' . $file_name;

                // حفظ النموذج
                $this->save();
            } catch (\Exception $e) {
                // في حالة حدوث خطأ أثناء النقل
                throw new \Exception('Failed to upload avatar: ' . $e->getMessage());
            }
        }
    }

    /**
     * get room avatar
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) {
            return asset($this->avatar);
        } else {
            return asset('assets/media/avatars/blank.png');
        }
    }

    /**
     * scope to filter rooms based on user_id
     */
    public function scopeForCurrentUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    /**
     * scope to filter rooms based on is_favorite
     */
    public function scopeIsFavorite($query)
    {
        return $query->where('is_favorite', 1);
    }

    /**
     * scope to filter rooms based on is_home
     */
    public function scopeIsHome($query)
    {
        return $query->where('is_home', 1);
    }

    /**
     * scope to filter rooms based on status
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_rooms');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
