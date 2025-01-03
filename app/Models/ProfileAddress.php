<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileAddress extends Model
{
    use HasFactory;

    protected $table = 'profile_address';

    protected $fillable = [
        'profile_id',
        'street',
        'zone',
        'psgc_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function psgc()
    {
        return $this->belongsTo(Psgc::class, 'psgc_id', 'id');
    }
}
