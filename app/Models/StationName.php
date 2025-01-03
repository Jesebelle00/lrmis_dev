<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationName extends Model
{
    use HasFactory;

    protected $table = 'station_name';

    protected $casts = ['id' => 'string', 'station_id' => 'string'];

    protected $fillable = [
        'station_id',
        'station_name',
        'shortname',
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
