<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudType extends Model
{
    use HasFactory;

    protected $table = 'crud_type';

    protected $fillable = [
        'crud_type_name',
        'has_detail'
    ];

    public function crudLogs()
    {
        return $this->hasMany(CrudLog::class, 'crud_type_id', 'id');
    }
}
