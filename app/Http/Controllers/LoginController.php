<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected ProfileService $profileService;

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $request->username)
            ->orWhereHas('profile.contactDetails', function ($query) use ($request) {
                $query->where('value', $request->username);
            })
            ->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password.'], 401);
        }

        $userStatusId = $user->userstatus_id;
        $userStatusName = UserStatus::where('id', $userStatusId)->value('name');

        // Handle user status
        switch ($userStatusName) {
            case 'Active': // Active account
                Auth::login($user);

                // Regenerate session ID
                session()->regenerate();

                session([
                    'profile_id' => $user->profile->id,
                    'usertype_id' => $user->usertype_id,
                    'authority_level' => $user->userType->stationType->authority_level,
                    'station_id' => $user->station_id,
                    'logged_in' => true,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful. Redirecting to Dashboard..',
                    'redirect_url' => url('/pages/dashboard'),
                ]);

            case 'Pending': // Inactive account
                return response()->json(['success' => false, 'message' => 'Your account is not yet activated.'], 403);

            case 'Deactivated': // Deactivated account
                return response()->json(['success' => false, 'message' => 'Your account has been deactivated.'], 403);

            default: // Unknown account status
                return response()->json(['success' => false, 'message' => 'Unknown account status.'], 400);
        }
    }

    public function getSessionData(Request $request)
    {
        if (!session()->has('logged_in') || !session('logged_in')) {
            return response()->json(['success' => false, 'message' => 'No active session found.'], 401);
        }

        return response()->json([
            'success' => true,
            'session_data' => [
                'profile_id' => session('profile_id'),
                'usertype_id' => session('usertype_id'),
                'shortcode' => session('shortcode'),
                'station_id' => session('station_id'),
                'logged_in' => session('logged_in'),
            ],
        ]);
    }

    private function getStation($level)
    {
        switch ($level) {
            case 1:
                return "station";
            case 2:
                return "region";
            case 3:
                return "division";
            case 4:
                return "district";
            default:
                return "school";
        }
    }

    public function dashboard()
    {
        if (!session()->has('logged_in') || !session('logged_in')) {
            return redirect()->route('login')->withErrors(['message' => 'You must be logged in to access the dashboard.']);
        }
    
        $profile_id = session('profile_id');
        $level = session('authority_level');

        // Fetch user details
        $user_details = $this->fetchUserDetails($profile_id, $level);

        if (empty($user_details)) {
            return redirect()->route('login')->withErrors(['message' => 'User details could not be found.']);
        }

        // Map contact details
        $contactValues = collect($user_details)->map(function ($userDetail) {
            return [
                'contact_id' => $userDetail['contact_id'],
                'contact_type_id' => $userDetail['contact_type_id'],
                'contact_value' => $userDetail['contact_value'],
                'contact_type_name' => $userDetail['contact_type_name'],
            ];
        })->toArray();

        // Get the station name based on user level
        $stationName = $this->getStation($level);

        // Create ProfileService instance
        $profileService = new ProfileService(
            $profile_id,
            $user_details[0]["user_name"],
            $user_details[0]["user_type_name"],
            $user_details[0]["user_type_level"],
            $user_details[0]["first_name"],
            $user_details[0]["last_name"],
            $user_details[0]["tin"],
            $user_details[0][$stationName] ?? '',
            $contactValues
        );
        
        // Fetch chart data
        $chartDataController = new ChartDataController();
        $printChartData = $chartDataController->getPrintChartData(); // This will return data from the ChartDataController
        $nonPrintChartData = $chartDataController->getNonPrintChartData(); // Data for non-print charts
        $totalLr = $chartDataController->getTotalLr();
        $totalLearners = $chartDataController->getTotalLearners();

        // Pass both profile data and chart data to the view
        return view('pages.dashboard', [
            'profileService' => $profileService,
            'subAvailData' => $printChartData['subAvailData'],
            'totalLrData' => $printChartData['totalLrData'],
            'sliVsPopData' => $printChartData['sliVsPopData'],
            'exdefData' => $printChartData['exdefData'],
            'heatmapData' => $printChartData['heatmapData'],
            'subAvailData_np' => $nonPrintChartData['subAvailData_np'],
            'totalLrData_np' => $nonPrintChartData['totalLrData_np'],
            'sliVsPopData_np' => $nonPrintChartData['sliVsPopData_np'],
            'exdefData_np' => $nonPrintChartData['exdefData_np'],
            'heatmapData_np' => $nonPrintChartData['heatmapData_np'],
            'printCount' => $totalLr['printCount'],
            'nonPrintCount' => $totalLr['nonPrintCount'],
            'gradeCount' => $totalLearners['gradeCount'],
            'totalPopulation' => $totalLearners['totalPopulation'],
        ]);
    }
        

    public function fetchUserDetails($profile_id, $level)
    {
        try {
            $query = User::query()
                ->select([
                    'user.name as user_name',
                    'user.usertype_id',
                    'user_type.name as user_type_name',
                    'user_type.user_level_id as user_type_level',
                    'user_type.shortcode as shortcode',
                    'profile.first_name',
                    'profile.last_name',
                    'profile.tin',
                    'contact_detail.id as contact_id',
                    'contact_detail.contacttype_id as contact_type_id',
                    'contact_detail.value as contact_value',
                    'contact_type.name as contact_type_name',
                ])
                ->join('profile', 'user.profile_id', '=', 'profile.id')
                ->join('user_type', 'user.usertype_id', '=', 'user_type.id')
                ->leftJoin('contact_detail', 'contact_detail.profile_id', '=', 'profile.id')
                ->leftJoin('contact_type', 'contact_detail.contacttype_id', '=', 'contact_type.id');

            // Dynamic station-level joins based on usertype_id
            if ($level == 1) {
                $query->addSelect('station_name.station_name as station')
                    ->leftJoin('station_name', 'station_name.station_id', '=', 'user.station_id');
            } elseif ($level == 2) {
                $query->addSelect(
                    'region_station.station_name as region',
                    'parent_station.station_name as parent_station'
                )
                    ->leftJoin('station_name as region_station', 'region_station.station_id', '=', 'user.station_id')
                    ->leftJoin('station as parent_station_data', 'parent_station_data.id', '=', 'region_station.station_id')
                    ->leftJoin('station_name as parent_station', 'parent_station.station_id', '=', 'parent_station_data.parent_station');
            } elseif ($level == 3) {
                $query->addSelect(
                    'division_station.station_name as division',
                    'region_station.station_name as region'
                )
                    ->leftJoin('station_name as division_station', 'division_station.station_id', '=', 'user.station_id')
                    ->leftJoin('station as region_station_data', 'region_station_data.id', '=', 'division_station.station_id')
                    ->leftJoin('station_name as region_station', 'region_station.station_id', '=', 'region_station_data.parent_station');
            } elseif ($level == 4) {
                $query->addSelect(
                    'district_station.station_name as district',
                    'division_station.station_name as division',
                    'region_station.station_name as region'
                )
                    ->leftJoin('station_name as district_station', 'district_station.station_id', '=', 'user.station_id')
                    ->leftJoin('station as division_station_data', 'division_station_data.id', '=', 'district_station.station_id')
                    ->leftJoin('station_name as division_station', 'division_station.station_id', '=', 'division_station_data.parent_station')
                    ->leftJoin('station as region_station_data', 'region_station_data.id', '=', 'division_station.station_id')
                    ->leftJoin('station_name as region_station', 'region_station.station_id', '=', 'region_station_data.parent_station');
            } else {
                $query->addSelect(
                    'school_station.station_name as school',
                    'district_station.station_name as district',
                    'division_station.station_name as division',
                    'region_station.station_name as region'
                )
                    ->leftJoin('station_name as school_station', 'school_station.station_id', '=', 'user.station_id')
                    ->leftJoin('station as district_station_data', 'district_station_data.id', '=', 'school_station.station_id')
                    ->leftJoin('station_name as district_station', 'district_station.station_id', '=', 'district_station_data.parent_station')
                    ->leftJoin('station as division_station_data', 'division_station_data.id', '=', 'district_station.station_id')
                    ->leftJoin('station_name as division_station', 'division_station.station_id', '=', 'division_station_data.parent_station')
                    ->leftJoin('station as region_station_data', 'region_station_data.id', '=', 'division_station.station_id')
                    ->leftJoin('station_name as region_station', 'region_station.station_id', '=', 'region_station_data.parent_station');
            }

            $userDetails = $query->where('profile.id', $profile_id)->get();

            return $userDetails;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function schoolResources()
    {
        return view('pages.school-resources');
    }

    public function index()
    {
        return view('index');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        session()->regenerate();
        return redirect('/');
    }
}
