<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationType extends Model
{
    use HasFactory;

    protected $table = 'station_type';
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'station_type_name',
        'description',
        'status',
    ];

    // Relationships
    public function userTypes()
    {
        return $this->hasMany(UserType::class, 'station_type_id', 'id');
    }

    public function stations()
    {
        return $this->hasMany(Station::class, 'station_type_id', 'id');
    }
}
