<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircularClassGrade extends Model
{
    use HasFactory;

    protected $table = 'circular_class_grade';

    protected $fillable = [
        'gradelevel_id',
        'circular_class_id'
    ];

    public function circularClass()
    {
        return $this->belongsTo(CircularClass::class, 'circular_class_id', 'id');
    }

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'gradelevel_id', 'id');
    }

    public function populations()
    {
        return $this->hasMany(Population::class, 'circular_class_grade_id', 'id');
    }
}
