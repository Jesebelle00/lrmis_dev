<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LRPrint extends Model
{
    use HasFactory;

    protected $table = 'lr_print';

    protected $fillable = [
        'lr_id',
        'publisher_id',
        'volume',
        'copyrightyear',
        'pages',
        'isbn',
        'date_update',
        'updated_by'
    ];

    public function lr()
    {
        return $this->belongsTo(LR::class, 'lr_id', 'id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
