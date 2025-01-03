<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $table = 'library';

    protected $fillable = [
        'station_id',
        'name'
    ];

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }

    public function acquisitions()
    {
        return $this->hasMany(Acquisition::class, 'library_id', 'id');
    }
}
