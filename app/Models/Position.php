<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'position';

    protected $fillable = [
        'name',
        'shortname',
    ];

    public function profilePositions()
    {
        return $this->hasMany(ProfilePosition::class, 'position_id', 'id');
    }
}
