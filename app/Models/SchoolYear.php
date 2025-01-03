<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $table = 'school_year';

    protected $fillable = [
        'from',
        'to',
    ];

    // Relationships
    public function populations()
    {
        return $this->hasMany(Population::class, 'schoolyear_id', 'id');
    }
}
