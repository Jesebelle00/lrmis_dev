<?php

namespace App\Http\Controllers;
use App\Models\StationType;
use App\Models\UserType;
use App\Models\Station;
use App\Models\ContactType;
use App\Models\UserStatus;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function getAuthorities()
    {
        $authorities = StationType::where('name', '!=', 'LRMIS Data Center')
                                  ->get(['id', 'name', 'authority_level']);
        return response()->json($authorities);
    }
    public function getUserTypes(Request $request)
    {
        $authorityId = $request->input('authority_id');
        if (!$authorityId) {
            return response()->json(['error' => 'Invalid authority ID'], 400);
        }
        $userTypes = UserType::where('user_level_id', $authorityId)->get(['id', 'name']);
        return response()->json($userTypes);
    }

    public function getRegions()
    {
        $stationTypeId = DB::table('station_type')->where('authority_level', 2)->select('id');
        $regions = DB::table('station as s')
            ->join('station_name as sn', 's.id', '=', 'sn.station_id')
            ->where('s.stationtype_id', $stationTypeId)
            ->select('s.id', 'sn.station_name')
            ->get();

        return response()->json($regions);
    }

    public function getDivisions(Request $request)
    {
        $regionId = $request->input('region_id');
        $stationTypeId = DB::table('station_type')->where('authority_level', 3)->select('id');
        if (!$regionId) {
            return response()->json(['error' => 'Invalid region ID'], 400);
        }
        $divisions = Station::join('station_name', 'station.id', '=', 'station_name.station_id')
            ->where('station.parent_station', $regionId)
            ->where('station.stationtype_id', $stationTypeId)
            ->select('station.id', 'station_name.station_name')
            ->get();

        return response()->json($divisions);
    }

    public function getDistricts(Request $request)
    {
        $divisionId = $request->input('division_id');
        $stationTypeId = DB::table('station_type')->where('authority_level', 4)->select('id');
        if (!$divisionId) {
            return response()->json(['error' => 'Invalid division ID'], 400);
        }
        $districts = Station::join('station_name', 'station.id', '=', 'station_name.station_id')
            ->where('station.parent_station', $divisionId)
            ->where('station.stationtype_id', $stationTypeId)
            ->select('station.id', 'station_name.station_name')
            ->get();

        return response()->json($districts);
    }

    public function getSchools(Request $request)
    {
        $districtId = $request->input('district_id');
        $stationTypeId = DB::table('station_type')->where('authority_level', 5)->select('id');
        if (!$districtId) {
            return response()->json(['error' => 'Invalid division ID'], 400);
        }
        $schools = Station::join('station_name', 'station.id', '=', 'station_name.station_id')
            ->where('station.parent_station', $districtId)
            ->where('station.stationtype_id', $stationTypeId)
            ->select('station.id', 'station_name.station_name')
            ->get();

        return response()->json($schools);
    }

    public function getContact()
    {
        $contactTypes = ContactType::all();
        return view('pages/register', compact('contactTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'authority' => 'required|string',
            'usertype' => 'required|string',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|unique:user,name',
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required|string|min:6',
            'tin_number' => 'required|string|unique:profile,tin',
            'contact_details' => 'nullable|array',
            'contact_details.*' => 'nullable|string',
        ]);

        $contactDetails = json_decode($request->input('contactDetails'), true);

        $authority = $request->input('authority');
        $station_id = null;

        $parts = explode('|', $authority);
        $authority_level = $parts[1];

        switch ($authority_level) {
            case 1:
                $station_id = null;
                break;
            case 2:
                $station_id = $request->input('region');
                break;
            case 3:
                $station_id = $request->input('division');
                break;
            case 4:
                $station_id = $request->input('district');
                break;
            case 5:
                $station_id = $request->input('school');
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid authority level.']);
        }

        DB::beginTransaction();

        try{
            $profileId = Str::uuid();

            $success = DB::table('profile')->insert([
                'id' => $profileId,
                'first_name' => $request->input('firstname'),
                'last_name' => $request->input('lastname'),
                'tin' => $request->input('tin_number'),
            ]);

            if($success){
                $activeStatusId = DB::table("user_status")
                    ->where('name', "Active")
                    ->value('id');

                DB::table('user')->insert([
                    'id' => Str::uuid(),
                    'name' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'station_id' => $station_id,
                    'usertype_id' => $request->input('usertype'),
                    'userstatus_id' => $activeStatusId,
                    'profile_id' => $profileId,
                ]);

                $contactDetails = json_decode($request->input('contactDetails'), true);

                if (is_array($contactDetails)) {
                    foreach ($contactDetails as $contactTypeId => $contactValue) {
                        $contactValue = trim($contactValue);
                        if (!empty($contactValue)) {
                            $existingContact = DB::table('contact_detail')
                                ->where('value', $contactValue)
                                ->exists();

                            if ($existingContact) {
                                $contactTypeName = DB::table('contact_type')
                                    ->where('id', $contactTypeId)
                                    ->value('name');
                                throw new Exception("This $contactTypeName already exists: $contactValue");
                            }

                            DB::table('contact_detail')->insert([
                                'id' => Str::uuid(),
                                'contacttype_id' => $contactTypeId,
                                'value' => $contactValue,
                                'profile_id' => $profileId,
                            ]);
                        }
                    }
                }

                DB::commit();
                return response()->json(['success' => true, 'message' => 'Registration successful!']);
            }
            else{
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Registration failed!']);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Validation failed: ' . $e->getMessage()]);            
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);            
        }
    }

}
