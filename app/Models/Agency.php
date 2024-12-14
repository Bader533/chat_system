<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'avatar',
        'status',
        'is_home'
    ];

    protected $appends = ['avatar_url'];


    protected $attributes = ['slug' => ''];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->slug = $data->generateSlug($data->name_en);
            $data->save();
        });
    }

    /**
     * generate slug
     */
    private function generateSlug($data)
    {
        if (static::whereSlug($slug = Str::slug($data))->exists()) {
            $max = static::where('name', $data)->latest('id')->skip(1)->value('slug');
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
     * get avatar
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) {
            return asset($this->avatar);
        } else {
            return asset('assets/media/avatars/blank.png');
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTotalDollarAttribute()
    {
        // جمع جميع قيم 'dollar' في علاقة wallets
        return $this->wallets->sum('dollar');
    }

    public function getTotalDiamondsAttribute()
    {
        // جمع جميع قيم 'diamonds' في علاقة wallets
        return $this->wallets->where('type', 'diamonds')->sum('quantity');
    }

    public function getTotalGoldAttribute()
    {
        // جمع جميع قيم 'gold' في علاقة wallets
        return $this->wallets->where('type', 'gold')->sum('quantity');
    }
}
