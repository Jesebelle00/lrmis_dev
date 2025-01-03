<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    protected $table = 'remarks';

    protected $fillable = [
        'name'
    ];

    public function statusUpdates()
    {
        return $this->hasMany(StatusUpdate::class, 'remarks_id', 'id');
    }
}
