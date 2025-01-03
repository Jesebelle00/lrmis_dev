<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    use HasFactory;

    protected $table = 'masterlist';

    protected $fillable = [
        'acquisition_id',
        'accession',
        'encoder_id'
    ];

    public function acquisition()
    {
        return $this->belongsTo(Acquisition::class, 'acquisition_id', 'id');
    }

    public function encoder()
    {
        return $this->belongsTo(User::class, 'encoder_id', 'id');
    }

    public function statusUpdates()
    {
        return $this->hasMany(StatusUpdate::class, 'masterlist_id', 'id');
    }

    public function borrowLogs()
    {
        return $this->hasMany(BorrowLog::class, 'masterlist_id', 'id');
    }
}
