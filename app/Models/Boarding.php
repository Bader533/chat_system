<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Boarding extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'place',
        'status',
        'avatar'
    ];

    protected $appends = ['avatar_url'];

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
}
