<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['cat_name', 'shortcode', 'child_link_table'];

    public function typeNames()
    {
        return $this->hasMany(TypeName::class, 'cat_id');
    }
}
