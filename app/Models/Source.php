<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table = 'source';

    protected $fillable = [
        'name',
        'shortcode'
    ];

    public function acquisitions()
    {
        return $this->hasMany(Acquisition::class, 'src_id', 'id');
    }
}
