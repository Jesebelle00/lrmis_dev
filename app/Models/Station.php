<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

     protected $table = 'station';

    protected $casts = ['id' => 'string', 'stationtype_id' => 'string'];

    protected $fillable = [
        'stationtype_id',
        'parent_station',
        'date_update',
        'geoloc',
        'encoded_by',
    ];

    /**
     * Define the relationship to StationType.
     */
    public function stationType()
    {
        return $this->belongsTo(StationType::class, 'stationtype_id');
    }

    /**
     * Define the relationship to the parent Station.
     */
    public function parentStation()
    {
        return $this->belongsTo(Station::class, 'parent_station');
    }

    /**
     * Define the relationship to the user who encoded the station.
     */
    public function encodedBy()
    {
        return $this->belongsTo(User::class, 'encoded_by');
    }
}
