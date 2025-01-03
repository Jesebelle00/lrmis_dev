<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    use HasFactory;

    protected $table = 'borrow_log';

    protected $fillable = [
        'masterlist_id',
        'borrower_id',
        'date_borrowed',
        'date_returned',
        'status_id'
    ];

    public function masterlist()
    {
        return $this->belongsTo(MasterList::class, 'masterlist_id', 'id');
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
