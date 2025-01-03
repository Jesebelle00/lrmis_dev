<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LrSubjectGradeLevel extends Model
{
    use HasFactory;

    protected $table = 'lr_subject_grade_level';

    protected $fillable = [
        'lr_id',
        'subjectgradelevel_id'
    ];

    public function lr()
    {
        return $this->belongsTo(Lr::class, 'lr_id', 'id');
    }

    public function subjectGradeLevel()
    {
        return $this->belongsTo(SubjectGradeLevel::class, 'subjectgradelevel_id', 'id');
    }
}
