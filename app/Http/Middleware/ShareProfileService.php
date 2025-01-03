<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LoginController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShareProfileService
{
    protected $loginController;

    public function __construct(LoginController $loginController)
    {
        $this->loginController = $loginController;
    }

    public function handle(Request $request, Closure $next)
    {
        if (session()->has('profile_id') && session()->has('usertype_id')) {
            try {
                $profile_id = session('profile_id');
                $usertype_id = session('usertype_id');

                $user_details = $this->loginController->fetchUserDetails($profile_id, $usertype_id);

                // Convert the collection to an array and extract 'contact_value'
                $contactValues = collect($user_details)->map(function ($userDetail) {
                    return [
                        'contact_id' => $userDetail['contact_id'],
                        'contact_type_id'  => $userDetail['contact_type_id'],
                        'contact_value' => $userDetail['contact_value'],
                        'contact_type_name'  => $userDetail['contact_type_name'],
                    ];
                })->toArray();

                if (!empty($user_details)) {
                    $profileService = new \App\Services\ProfileService(
                        $profile_id,
                        $user_details[0]["user_name"],
                        $user_details[0]["user_type_name"],
                        $user_details[0]["user_type_level"],
                        $user_details[0]["first_name"],
                        $user_details[0]["last_name"],
                        $user_details[0]["tin"],
                        $user_details[0]["school"] ?? '',
                        $contactValues
                    );

                    view()->share('profileService', $profileService);
                }
            } catch (\Exception $e) {
                Log::error('Failed to share ProfileService: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}
