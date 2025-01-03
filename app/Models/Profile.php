<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'tin'
    ];

    public function positions()
    {
        return $this->hasMany(ProfilePosition::class, 'profile_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(ProfilePhoto::class, 'profile_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(ProfileAddress::class, 'profile_id', 'id');
    }

    public function stationHead()
    {
        return $this->hasOne(StationHead::class, 'profile_id', 'id');
    }

    public function contactDetails()
    {
        return $this->hasMany(ContactDetail::class, 'profile_id', 'id');
    }
}
