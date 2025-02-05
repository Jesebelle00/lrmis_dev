<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'author';

    protected $fillable = [
        'name'
    ];

    public function titles()
    {
        return $this->belongsToMany(Title::class, 'title_author', 'author_id', 'title_id');
    }
}
