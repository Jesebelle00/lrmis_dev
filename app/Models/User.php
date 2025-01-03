<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'id',
        'profile_id',
        'name',
        'password',
        'station_id',
        'usertype_id',
        'date_created',
        'user_status_id',
        'date_update',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id' => 'string',
        'date_created' => 'datetime',
        'date_update' => 'datetime',
    ];

    // Relationships
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'usertype_id', 'id');
    }

    public function userStatus()
    {
        return $this->belongsTo(UserStatus::class, 'user_status_id', 'id');
    }

    public function encodedStations()
    {
        return $this->hasMany(Station::class, 'encoded_by', 'id');
    }

    public function crudLogs()
    {
        return $this->hasMany(CrudLog::class, 'trans_by', 'id');
    }

    public function crudLogDetails()
    {
        return $this->hasMany(CrudLogDetail::class, 'updated_by', 'id');
    }

    public function encodedLearningResources()
    {
        return $this->hasMany(Lr::class, 'encoder_id', 'id');
    }

    public function updatedNonPrintLrs()
    {
        return $this->hasMany(LrNonprint::class, 'updated_by', 'id');
    }

    public function updatedPrintLrs()
    {
        return $this->hasMany(LrPrint::class, 'updated_by', 'id');
    }

    public function encodedMasterlists()
    {
        return $this->hasMany(Masterlist::class, 'encoder_id', 'id');
    }

    public function updatedPopulationRecords()
    {
        return $this->hasMany(Population::class, 'updated_by', 'id');
    }

    public function encodedStationLogos()
    {
        return $this->hasMany(StationLogo::class, 'encoded_by', 'id');
    }

    public function encodedStationAddresses()
    {
        return $this->hasMany(StationAddress::class, 'encoded_by', 'id');
    }

    public function encodedStationContacts()
    {
        return $this->hasMany(StationContact::class, 'encoded_by', 'id');
    }

    public function encodedStationHeads()
    {
        return $this->hasMany(StationHead::class, 'encoded_by', 'id');
    }

    public function encodedStationNames()
    {
        return $this->hasMany(StationName::class, 'encoded_by', 'id');
    }

    public function updatedStatusUpdates()
    {
        return $this->hasMany(StatusUpdate::class, 'updatedby', 'id');
    }

    public function borrowedLogs()
    {
        return $this->hasMany(BorrowLog::class, 'borrower_id', 'id');
    }

    public function encodedAcquisitions()
    {
        return $this->hasMany(Acquisition::class, 'encoder_id', 'id');
    }

    public function encodedBeisRecords()
    {
        return $this->hasMany(Beis::class, 'encoded_by', 'id');
    }

    /**
     * Check if the user is active.
     */
    public function isActive(): bool
    {
        return $this->userstatus_id === 1;
    }

    /**
     * Verify the password.
     *
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}
