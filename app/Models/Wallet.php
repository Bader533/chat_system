<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'slug',
        'type',
        'quantity',
        'dollar',
        'user_id',
        'agency_id'
    ];

    protected $attributes = ['slug' => ''];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->slug = $data->generateSlug($data->name);
            $data->save();
        });
    }

    private function generateSlug()
    {
        $slug = Str::slug(uniqid('slug-', true)); // Generate a unique slug with a prefix
        while (static::whereSlug($slug)->exists()) {
            $slug = Str::slug(uniqid('slug-', true)); // Regenerate if the slug already exists
        }
        return $slug;
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearchUser($query, $data)
    {
        return $query->whereHas('user', function ($q) use ($data) {
            $q->where('name', 'like', '%' . $data . '%');
        });
    }

    public function scopeSearchAgency($query, $data)
    {
        return $query->whereHas('agency', function ($q) use ($data) {
            $q->where('name', 'like', '%' . $data . '%');
        });
    }
}
