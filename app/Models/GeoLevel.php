<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoLevel extends Model
{
    use HasFactory;

    protected $table = 'geo_level';

    protected $fillable = [
        'name',
        'shortcode',
        'level',
    ];

    // Relationships
    public function psgcs()
    {
        return $this->hasMany(Psgc::class, 'geolevel_id', 'id');
    }
}
