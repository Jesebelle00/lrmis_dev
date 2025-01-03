<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beis extends Model
{
    use HasFactory;

    protected $table = 'beis';

    protected $fillable = [
        'station_id',
        'beis_id',
        'schooltype_id',
        'date_established',
        'circular_class_id',
        'date_update',
        'encoded_by',
    ];

    // Relationships
    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }

    public function schoolType()
    {
        return $this->belongsTo(SchoolType::class, 'schooltype_id', 'id');
    }

    public function circularClass()
    {
        return $this->belongsTo(CircularClass::class, 'circular_class_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'encoded_by', 'id');
    }

    public function population()
    {
        return $this->hasMany(Population::class, 'beis_id', 'id');
    }
}
