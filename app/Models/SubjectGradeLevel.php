<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectGradeLevel extends Model
{
    use HasFactory;

    protected $table = 'subject_grade_level';

    protected $fillable = [
        'subject_id',
        'gradelevel_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'gradelevel_id', 'id');
    }

    public function lrSubjectGradeLevels()
    {
        return $this->hasMany(LrSubjectGradeLevel::class, 'subjectgradelevel_id', 'id');
    }
}
