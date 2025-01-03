<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUpdate extends Model
{
    use HasFactory;

    protected $table = 'status_update';

    protected $fillable = [
        'masterlist_id',
        'status_id',
        'date_update',
        'remarks_id',
        'updatedby'
    ];

    public function masterlist()
    {
        return $this->belongsTo(MasterList::class, 'masterlist_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function remarks()
    {
        return $this->belongsTo(Remark::class, 'remarks_id', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updatedby', 'id');
    }
}
