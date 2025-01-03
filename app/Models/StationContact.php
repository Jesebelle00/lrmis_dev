<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationContact extends Model
{
    use HasFactory;

    protected $table = 'station_contact';

    protected $fillable = [
        'station_id',
        'contacttype_id',
        'value',
        'date_update',
        'encoded_by',
    ];

    // Relationships
    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }

    public function contactType()
    {
        return $this->belongsTo(ContactType::class, 'contacttype_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'encoded_by', 'id');
    }
}
