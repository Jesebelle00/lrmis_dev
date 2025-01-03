<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    use HasFactory;

    protected $table = 'acquisition';

    protected $fillable = [
        'library_id',
        'lr_id',
        'src_id',
        'date_acquired',
        'qty',
        'cost',
        'status_id',
        'date_encoded',
        'encoder_id'
    ];

    public function library()
    {
        return $this->belongsTo(Library::class, 'library_id', 'id');
    }

    public function lr()
    {
        return $this->belongsTo(Lr::class, 'lr_id', 'id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'src_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function encoder()
    {
        return $this->belongsTo(User::class, 'encoder_id', 'id');
    }

    public function masterlist()
    {
        return $this->hasMany(MasterList::class, 'acquisition_id', 'id');
    }
}
