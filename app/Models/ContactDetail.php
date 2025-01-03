<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;

    protected $table = 'contact_detail';
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'id',
        'contacttype_id',
        'value',
        'profile_id',
    ];

    public function contactType()
    {
        return $this->belongsTo(ContactType::class, 'contacttype_id', 'id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
