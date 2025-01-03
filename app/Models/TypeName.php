<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeName extends Model
{
    use HasFactory;

    protected $table = 'type_name';

    protected $fillable = [
        'cat_id',
        'type_name',
        'shortcode'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function lrs()
    {
        return $this->hasMany(LR::class, 'type_id', 'id');
    }
}
