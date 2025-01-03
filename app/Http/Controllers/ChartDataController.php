<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ChartDataController extends Controller
{
    // print data
    public function getPrintChartData()
    {
        Log::info('Session authority_level: ' . session('authority_level'));
        Log::info('Session station_id: ' . session('station_id'));

        $stationColumn = match (session('authority_level')) {
            2 => 'region',
            3 => 'division',
            4 => 'district',
            5 => 'station_id',
            default => null
        };

        if (!$stationColumn) {
            return abort(403, 'Unauthorized action.');
        }

        $stationId = session('station_id');
        $status = 'Usable';

        $subAvailData = DB::table('datatable_print')
            ->select(['qty', 'subject_shortcode', 'population', 'grade_level'])
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->get();

        $totalLrData = DB::table('datatable_print')
            ->select(
                DB::raw('COALESCE(SUM(qty), 0) AS total_lr'),
                DB::raw('COALESCE(population, 0) AS population'),
                'grade_level'
            )
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->groupBy('grade_level', 'population')
            ->get();

        $sliVsPopData = DB::table('datatable_print')
            ->select(
                DB::raw('COALESCE(SUM(qty), 0) AS lr'),
                DB::raw('COALESCE(SUM(population), 0) AS population'),
                'shortname'
            )
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->groupBy('shortname')
            ->get();

        $exdefData = DB::table('datatable_print')
            ->select(
                'grade_level',
                'subject_shortcode',
                DB::raw('(COALESCE(SUM(qty), 0) - COALESCE(population, 0)) AS exdef'),
                DB::raw('COALESCE(SUM(qty), 0) AS qty'),
                'population',
                DB::raw('CASE WHEN COALESCE(population, 0) = 0 THEN NULL ELSE (COALESCE(SUM(qty), 0) / COALESCE(population, 0)) END AS ratio')
            )
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->groupBy('grade_level', 'subject_shortcode', 'population')
            ->get();

        $heatmapData = DB::table('datatable_print')
            ->select('grade_level', 'subject_shortcode', 'qty')
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->groupBy('grade_level', 'subject_shortcode', 'qty')
            ->get();

        return view('pages.charts.print', [
            'subAvailData' => $subAvailData,
            'totalLrData' => $totalLrData,
            'sliVsPopData' => $sliVsPopData,
            'exdefData' => $exdefData,
            'heatmapData' => $heatmapData
        ]);
    }

    // nonprint data
    public function getNonPrintChartData()
    {
        $stationType = match (session('authority_level')) {
            2 => 'region',
            3 => 'division',
            4 => 'district',
            5 => 'station_id',
            default => null,
        };
    
        if (!$stationType) {
            return response()->json(['error' => 'Invalid user type'], 400);
        }
    
        $stationId = session('station_id');
        $commonConditions = [
            [$stationType, '=', $stationId],
            ['status', '=', 'Usable'],
        ];

        $subAvailData_np = DB::table('datatable_non_print')
            ->select(['qty', 'subject_shortcode', 'population', 'grade_level'])
            ->where($commonConditions)
            ->get();
    
        $totalLrData_np = DB::table('datatable_non_print')
            ->select(
                DB::raw('COALESCE(SUM(qty), 0) AS total_lr'),
                DB::raw('COALESCE(population, 0) AS population'),
                'grade_level'
            )
            ->where($commonConditions)
            ->groupBy('grade_level', 'population')
            ->get();
            
        $sliVsPopData_np = DB::table('datatable_non_print')
            ->select(
                DB::raw('COALESCE(SUM(qty), 0) AS lr'),
                DB::raw('COALESCE(SUM(population), 0) AS population'),
                'shortname'
            )
            ->where($commonConditions)
            ->groupBy('shortname')
            ->get();

        $exdefData_np = DB::table('datatable_non_print')
            ->select(
                'grade_level',
                'subject_shortcode',
                DB::raw('(COALESCE(SUM(qty), 0) - COALESCE(population, 0)) AS exdef'),
                DB::raw('COALESCE(SUM(qty), 0) AS qty'),
                'population',
                DB::raw('CASE 
                            WHEN COALESCE(population, 0) = 0 THEN NULL
                            ELSE (COALESCE(SUM(qty), 0) / COALESCE(population, 0))
                         END AS ratio')
            )
            ->where($commonConditions)
            ->groupBy('grade_level', 'subject_shortcode', 'population')
            ->get();
    
        $heatmapData_np = DB::table('datatable_non_print')
            ->select('grade_level', 'subject_shortcode', 'qty')
            ->where($commonConditions)
            ->groupBy('grade_level', 'subject_shortcode', 'qty')
            ->get();
    
        return view('pages.charts.non_print', [
            'subAvailData_np' => $subAvailData_np,
            'totalLrData_np' => $totalLrData_np,
            'sliVsPopData_np' => $sliVsPopData_np,
            'exdefData_np' => $exdefData_np,
            'heatmapData_np' => $heatmapData_np,
        ]);
    }

    // print and non print count
    public function getTotalLr()
    {        
        // Log session data for debugging
        Log::info('Session authority_level: ' . session('authority_level'));
        Log::info('Session station_id: ' . session('station_id'));
        
        // Determine the station column based on authority_level
        $stationColumn = match (session('authority_level')) {
            2 => 'region',
            3 => 'division',
            4 => 'district',
            5 => 'station_id',
            default => null
        };
        
        // Abort if the user is unauthorized
        if (!$stationColumn) {
            abort(403, 'Unauthorized action.');
        }
        
        $stationId = session('station_id');
        $status = 'Usable';
        
        // Count the station_id based on the session criteria
        $printCount = DB::table('datatable_print')
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->sum('qty');

        // Count the station_id based on the session criteria
        $nonPrintCount = DB::table('datatable_non_print')
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->sum('qty');

        return view('pages.charts.total_lr', [
            'printCount' => $printCount,
            'nonPrintCount' => $nonPrintCount,
        ]);
    }
    public function getTotalLearners()
    {
        // Log session data for debugging
        Log::info('Session authority_level: ' . session('authority_level'));
        Log::info('Session station_id: ' . session('station_id'));
        
        // Determine the station column based on authority_level
        $stationColumn = match (session('authority_level')) {
            2 => 'region',
            3 => 'division',
            4 => 'district',
            5 => 'station_id',
            default => null
        };
        
        // Abort if the user is unauthorized
        if (!$stationColumn) {
            abort(403, 'Unauthorized action.');
        }
        
        $stationId = session('station_id');
        $status = 'Usable';
        
        // Count the station_id based on the session criteria
        $gradeCount = DB::table('datatable_print')
        ->select(
            'grade_level',
            DB::raw('SUM(COALESCE(population, 0)) AS total_population')
        )
        ->where($stationColumn, $stationId)
        ->where('status', $status)
        ->groupBy('grade_level')
        ->orderByRaw('CASE grade_level
            WHEN "Kindergarten" THEN 1
            WHEN "Grade 1" THEN 2
            WHEN "Grade 2" THEN 3
            WHEN "Grade 3" THEN 4
            WHEN "Grade 4" THEN 5
            WHEN "Grade 5" THEN 6
            WHEN "Grade 6" THEN 7
            ELSE 8 END')
        ->get();

        // Count the station_id based on the session criteria
        $gradeTotal = DB::table('datatable_print')
            ->select(
                DB::raw('SUM(COALESCE(population, 0)) AS total_population')
            )
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->first(); // Get the sum of population

        // Extract the total population
        $totalPopulation = $gradeTotal ? $gradeTotal->total_population : 0; // Ensure it's 0 if no result

        // Now, return the view and pass the required data
        return view('pages.charts.total_learners', compact('gradeCount', 'totalPopulation'));
    }
}
