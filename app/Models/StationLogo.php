<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationLogo extends Model
{
    use HasFactory;

    protected $table = 'station_logo';

    protected $fillable = [
        'station_id',
        'image',
        'date_update',
        'encoded_by',
    ];

    // Relationships
    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'encoded_by', 'id');
    }
}
