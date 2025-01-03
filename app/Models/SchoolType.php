<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolType extends Model
{
    use HasFactory;

    protected $table = 'school_type';

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function beis()
    {
        return $this->hasMany(Beis::class, 'schooltype_id', 'id');
    }
}
