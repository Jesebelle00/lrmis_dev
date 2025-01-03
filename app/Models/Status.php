<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'name'
    ];

    public function borrowLogs()
    {
        return $this->hasMany(BorrowLog::class, 'status_id', 'id');
    }

    public function acquisitions()
    {
        return $this->hasMany(Acquisition::class, 'status_id', 'id');
    }

    public function statusUpdates()
    {
        return $this->hasMany(StatusUpdate::class, 'status_id', 'id');
    }
}
