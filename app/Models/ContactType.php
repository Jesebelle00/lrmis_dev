<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    use HasFactory;

    protected $table = 'contact_type';
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'contacttype_id',
        'name',
    ];

    // Relationships
    public function contactDetails()
    {
        return $this->hasMany(ContactDetail::class, 'contacttype_id', 'id');
    }

    public function stationContacts()
    {
        return $this->hasMany(StationContact::class, 'contacttype_id', 'id');
    }
}
