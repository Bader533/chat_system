<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'type',
        'email',
        'password',
    ];

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

    /**
     * get user avatar
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) {
            return asset('images/' . $this->avatar);
        } else {
            return asset('assets/media/svg/files/blank-image.svg');
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

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
