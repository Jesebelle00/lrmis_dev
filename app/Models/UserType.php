<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $table = 'user_type';
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'name',
        'shortcode',
        'user_level_id',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class, 'usertype_id', 'id');
    }

    public function stationType()
    {
        return $this->belongsTo(StationType::class, 'user_level_id', 'id');
    }
}
