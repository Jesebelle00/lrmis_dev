<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudLogDetail extends Model
{
    use HasFactory;

    protected $table = 'crud_log_detail';

    protected $fillable = [
        'crud_log_id',
        'column_name',
        'change_from',
        'change_to'
    ];

    public function crudLog()
    {
        return $this->belongsTo(CrudLog::class, 'crud_log_id', 'id');
    }
}
