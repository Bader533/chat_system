<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyHost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'agent_ratio',
        'host_ratio',
        'management_ratio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agencyPoint()
    {
        return $this->hasOne(AgencyPoint::class);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'agency_host_users')
            ->withPivot('status') // Include the `status` column from the pivot table
            ->withTimestamps(); // Include timestamps from the pivot table
    }
}
