<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationHead extends Model
{
    use HasFactory;

    protected $table = 'station_head';

    protected $fillable = [
        'station_id',
        'profile_id',
        'date_update',
        'encoded_by',
    ];

    // Relationships
    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'encoded_by', 'id');
    }
}
