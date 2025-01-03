<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LRNonPrint extends Model
{
    use HasFactory;

    protected $table = 'lr_nonprint';

    protected $fillable = [
        'lr_id',
        'brand_id',
        'code',
        'url',
        'size',
        'model',
        'date_updated',
        'updated_by'
    ];

    public function lr()
    {
        return $this->belongsTo(LR::class, 'lr_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
