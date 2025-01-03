<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleAuthor extends Model
{
    use HasFactory;

    protected $table = 'title_author';

    // No need to define $fillable since this is a pivot table

    public $timestamps = false;  // Assuming there are no timestamps in this pivot table

    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
