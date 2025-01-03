<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory;

    protected $table = 'grade_level';

    protected $fillable = [
        'name',
        'shortcode'
    ];

    public function circularClassGrades()
    {
        return $this->hasMany(CircularClassGrade::class, 'gradelevel_id', 'id');
    }

    public function subjectGradeLevels()
    {
        return $this->hasMany(SubjectGradeLevel::class, 'gradelevel_id', 'id');
    }
}
