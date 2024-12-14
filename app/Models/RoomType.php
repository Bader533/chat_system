<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_en',
        'name_ar',
        'avatar',
        'status',
    ];

    protected $attributes = ['slug' => ''];

    protected $appends = ['avatar_url'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->slug = $data->generateSlug($data->name_en);
            $data->save();
        });
    }

    private function generateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::where('name_en', $name)->latest('id')->skip(1)->value('slug');
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
     * get roomtype avatar
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
     * scope to filter rooms based on status
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
