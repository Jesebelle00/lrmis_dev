<?php
// app/Services/ProfileService.php
namespace App\Services;

class ProfileService
{
    public string $ProfileID;
    public string $Username;
    public string $Type;
    public string $Level;
    public string $Firstname;
    public string $Lastname;
    public string $TIN;
    public string $StationName;
    public array $Contacts;

    // Constructor to initialize properties
    public function __construct(
        string $ProfileID,
        string $Username,
        string $Type,
        string $Level,
        string $Firstname,
        string $Lastname,
        string $TIN,
        string $StationName,
        array $Contacts
    ) {
        $this->ProfileID = $ProfileID;
        $this->Username = $Username;
        $this->Type = $Type;
        $this->Level = $Level;
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
        $this->TIN = $TIN;
        $this->StationName = $StationName;
        $this->Contacts = $Contacts;
    }

    // Method to return the profile data as an object
    public function getProfileData(): object
    {
        // Creating a stdClass object to return the data
        $profile = new \stdClass();
        $profile->ProfileID = $this->ProfileID;
        $profile->Username = $this->Username;
        $profile->Type = $this->Type;
        $profile->Level = $this->Level;
        $profile->Firstname = $this->Firstname;
        $profile->Lastname = $this->Lastname;
        $profile->TIN = $this->TIN;
        $profile->StationName = $this->StationName;
        $profile->Contacts = $this->Contacts;

        return $profile;
    }
}
