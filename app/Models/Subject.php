<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';

    protected $fillable = [
        'title',
        'shortcode'
    ];

    public function subjectGradeLevels()
    {
        return $this->hasMany(SubjectGradeLevel::class, 'subject_id', 'id');
    }

    public function lrSubjectGradeLevels()
    {
        return $this->hasMany(LrSubjectGradeLevel::class, 'subject_id', 'id');
    }
}
