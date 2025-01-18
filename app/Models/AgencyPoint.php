<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_host_id',
        'user_id',
        'diamonds',
        'gold',
        'silver'
    ];

    public function agencyHost()
    {
        return $this->belongsTo(AgencyHost::class);
    }
}
