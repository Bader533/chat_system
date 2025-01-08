<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'status',
        'type',
        'email',
        'phone',
        'avatar',
        'password',
    ];

    protected $appends = ['avatar_url'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

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
     * get user avatar
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) {
            return asset($this->avatar);
        } else {
            return asset('assets/media/avatars/blank.png');
        }
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function scopeForCurrentUser($query)
    {
        return $query->where('id', auth()->user()->id);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsEmployee($query)
    {
        return $query->whereIn('type', [0, 1]);
    }

    public function favoriteRooms()
    {
        return $this->belongsToMany(Room::class, 'favorite_rooms');
    }

    public function scopeGetUser($query)
    {
        return $query->forCurrentUser()->isActive()->firstOrFail();
    }

    // المتابعون
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    // المستخدمين الذين يتابعهم
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function follow(User $user)
    {
        if (!$this->isFollowing($user)) {
            $this->following()->attach($user->id);
        }
    }

    public function unfollow(User $user)
    {
        if ($this->isFollowing($user)) {
            $this->following()->detach($user->id);
        }
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function getTotalDiamondsAttribute()
    {
        return $this->wallet()->sum('diamonds');
    }

    public function getTotalGoldAttribute()
    {
        return $this->wallet()->sum('gold');
    }

    public function getTotalSilverAttribute()
    {
        return $this->wallet()->sum('silver');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id')->select('id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'avatar', 'user_id');
    }

    public function likePosts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    public function commentPosts()
    {
        return $this->belongsToMany(Post::class, 'comments', 'user_id', 'post_id');
    }

    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class, 'user_levels')->withPivot('score', 'completed')->withTimestamps();
    }

    public function sentGifts()
    {
        return $this->hasMany(UserGift::class, 'sender_id');
    }

    public function receivedGifts()
    {
        return $this->hasMany(UserGift::class, 'receiver_id');
    }

    public function transactions()
    {
        return $this->hasMany(GiftTransaction::class);
    }

    public function matjarProducts()
    {
        return $this->belongsToMany(MatjarProduct::class, 'user_products', 'user_id', 'matjar_product_id')
            ->withPivot(['created_at', 'updated_at']);
    }

    public function agencyHost()
    {
        return $this->hasOne(AgencyHost::class);
    }

    public function agencyHosts()
    {
        return $this->belongsToMany(AgencyHost::class, 'agency_host_users')
            ->withPivot('status') // Include the `status` column from the pivot table
            ->withTimestamps(); // Include timestamps from the pivot table
    }
}
