<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $table = 'title';

    protected $fillable = [
        'name',
        'image'
    ];

    public function lrs()
    {
        return $this->hasMany(Lr::class, 'title_id', 'id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'title_author', 'title_id', 'author_id');
    }
}
