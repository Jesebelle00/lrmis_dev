<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psgc extends Model
{
    use HasFactory;

    protected $table = 'psgc';

    protected $fillable = [
        'digitcode',
        'name',
        'geolevel_id',
        'parent_psgc',
    ];

    // Relationships
    public function geolevel()
    {
        return $this->belongsTo(GeoLevel::class, 'geolevel_id', 'id');
    }

    public function parentPsgc()
    {
        return $this->belongsTo(Psgc::class, 'parent_psgc', 'id');
    }

    public function profileAddresses()
    {
        return $this->hasMany(ProfileAddress::class, 'psgc_id', 'id');
    }

    public function stationAddresses()
    {
        return $this->hasMany(StationAddress::class, 'psgc_id', 'id');
    }
}
