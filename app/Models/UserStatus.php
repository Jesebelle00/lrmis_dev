<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $table = 'user_status';
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class, 'user_status_id', 'id');
    }
}
