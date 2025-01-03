<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudLog extends Model
{
    use HasFactory;

    protected $table = 'crud_log';

    protected $fillable = [
        'table_name',
        'id_name',
        'id_value',
        'crud_type_id',
        'trans_date',
        'trans_by'
    ];

    public function crudType()
    {
        return $this->belongsTo(CrudType::class, 'crud_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'trans_by', 'id');
    }

    public function crudLogDetails()
    {
        return $this->hasMany(CrudLogDetail::class, 'crud_log_id', 'id');
    }
}
