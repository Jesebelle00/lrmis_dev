<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LR extends Model
{
    use HasFactory;

    protected $table = 'lr';

    protected $fillable = [
        'type_id',
        'title_id',
        'date_update',
        'encoder_id'
    ];

    public function typeName()
    {
        return $this->belongsTo(TypeName::class, 'type_id', 'id');
    }

    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id', 'id');
    }

    public function encoder()
    {
        return $this->belongsTo(User::class, 'encoder_id', 'id');
    }

    public function lrPrint()
    {
        return $this->hasMany(LrPrint::class, 'lr_id', 'id');
    }

    public function lrNonPrint()
    {
        return $this->hasMany(LrNonPrint::class, 'lr_id', 'id');
    }

    public function lrSubjectGradeLevels()
    {
        return $this->hasMany(LrSubjectGradeLevel::class, 'lr_id', 'id');
    }
}
