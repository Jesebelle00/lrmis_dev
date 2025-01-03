<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationAddress extends Model
{
    use HasFactory;

    protected $table = 'station_address';

    protected $fillable = [
        'station_id',
        'street',
        'zone',
        'psgc_id',
        'date_update',
        'encoded_by'
    ];

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }

    public function psgc()
    {
        return $this->belongsTo(Psgc::class, 'psgc_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'encoded_by', 'id');
    }
}
