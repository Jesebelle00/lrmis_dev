<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $table = 'population';

    protected $fillable = [
        'schoolyear_id',
        'beis_id',
        'circular_class_grade_id',
        'population',
        'updated_by',
    ];

    // Relationships
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'schoolyear_id', 'id');
    }

    public function beis()
    {
        return $this->belongsTo(Beis::class, 'beis_id', 'id');
    }

    public function circularClassGrade()
    {
        return $this->belongsTo(CircularClassGrade::class, 'circular_class_grade_id', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
