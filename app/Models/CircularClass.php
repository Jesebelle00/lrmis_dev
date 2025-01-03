<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircularClass extends Model
{
    use HasFactory;

    protected $table = 'circular_class';

    protected $fillable = [
        'name'
    ];

    public function beis()
    {
        return $this->hasMany(Beis::class, 'circular_class_id', 'id');
    }

    public function circularClassGrades()
    {
        return $this->hasMany(CircularClassGrade::class, 'circular_class_id', 'id');
    }

    public function populations()
    {
        return $this->hasMany(Population::class, 'circular_class_grade_id', 'id');
    }
}
