<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    RegisterController,
    SchoolResourceController,
    LRHubController,
    AddResourceController,
    UserProfileController,
    StationProfileController,
    ViewResourceController
};
use App\Http\Middleware\ShareProfileService;

// Default Redirect
Route::get('/', fn() => redirect()->route('index'));

// Public Routes
Route::get('/index', [LoginController::class, 'index'])->name('index');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::view('/pages/register', '/pages/register')->name('pages.register');
Route::post('/pages/register', [RegisterController::class, 'store']);
Route::get('/pages/register', [RegisterController::class, 'getContact']);

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/authorities', [RegisterController::class, 'getAuthorities']);
    Route::get('/user-types', [RegisterController::class, 'getUserTypes']);
    Route::get('/regions', [RegisterController::class, 'getRegions']);
    Route::get('/divisions', [RegisterController::class, 'getDivisions']);
    Route::get('/districts', [RegisterController::class, 'getDistricts']);
    Route::get('/schools', [RegisterController::class, 'getSchools']);
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/pages/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/pages/school-resources', [LoginController::class, 'schoolResources'])->name('school-resources');

    // Protected Views
    Route::view('/pages/profile', '/pages/profile')->name('pages.profile');
    Route::view('/pages/add-resources', '/pages/add-resources')->name('pages.add-resources');
    Route::view('/pages/school-resources', '/pages/school-resources')->name('pages.school-resources');
    Route::view('/pages/lr-hubs', '/pages/lr-hubs')->name('pages.lr-hubs');
    Route::view('/pages/borrowers-log', '/pages/borrowers-log')->name('pages.borrowers-log');
    Route::view('/pages/reports', '/pages/reports')->name('pages.reports');
    Route::view('/pages/user-profile', '/pages/user-profile')->name('pages.user-profile');
    Route::view('/pages/station-profile', '/pages/station-profile')->name('pages.station-profile');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware([
    ShareProfileService::class,
])->group(function () {

    Route::view('/pages/profile', '/pages/profile')->name('pages.profile');
    Route::view('/pages/add-resources', '/pages/add-resources')->name('pages.add-resources');
    Route::view('/pages/school-resources', '/pages/school-resources')->name('pages.school-resources');
    Route::view('/pages/lr-hubs', '/pages/lr-hubs')->name('pages.lr-hubs');
    Route::view('/pages/borrowers-log', '/pages/borrowers-log')->name('pages.borrowers-log');
    Route::view('/pages/reports', '/pages/reports')->name('pages.reports');
    Route::view('/pages/user-profile', '/pages/user-profile')->name('pages.user-profile');
    Route::view('/pages/station-profile', '/pages/station-profile')->name('pages.station-profile');

    Route::get('/pages/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    Route::get('/pages/school-resources', [LoginController::class, 'schoolResources'])->name('pages.school-resources');
    Route::post('/get-print-resources', [SchoolResourceController::class, 'getPrintResources']);
    Route::post('/get-nonprint-resources', [SchoolResourceController::class, 'getNonPrintResources']);
    Route::post('/get-print-lrhubs', [LRHubController::class, 'getPrintLRHubs']);
    Route::post('/get-nonprint-lrhubs', [LRHubController::class, 'getNonPrintLRHubs']);
    Route::post('/add-print-resource', [AddResourceController::class, 'addPrintResource'])->name('add-print-resource');

    Route::get('/pages/user-profile/data', [UserProfileController::class, 'getData'])->name('user-profile.data');
    Route::get('/pages/station-profile/data', [StationProfileController::class, 'getData'])->name('station-profile.data');
    Route::get('/view-resource-print/{id}', [ViewResourceController::class, 'show'])->name('view-resource-print');
    Route::get('/view-resource-nonprint/{id}', [ViewResourceController::class, 'showNonPrint'])->name('view-resource-nonprint');

});

Route::get('/titles', [SchoolResourceController::class, 'fetchTitles']);
Route::get('/print-types', [AddResourceController::class, 'getPrintTypes']);
Route::get('/nonprint-types', [AddResourceController::class, 'getNonPrintTypes']);
Route::get('/sources', [AddResourceController::class, 'source']);
Route::get('/status', [AddResourceController::class, 'status']);
Route::get('/subjectgradelevel', [AddResourceController::class, 'subjectgradeLevel']);
Route::get('/subjectgradelevels', [AddResourceController::class, 'getSubjectGradeLevels']);
Route::get('/subjects', [AddResourceController::class, 'getSubjects']);
Route::get('/search-titles', [AddResourceController::class, 'searchTitle']);
Route::get('/search-authors', [AddResourceController::class, 'searchAuthor']);
Route::get('/search-publishers', [AddResourceController::class, 'searchPublisher']);
Route::get('/search-brands', [AddResourceController::class, 'searchBrand']);
Route::view('/add-resources', 'pages.add-resources');


/* QR-CODE  */
require __DIR__.'/qrRoutes.php';
