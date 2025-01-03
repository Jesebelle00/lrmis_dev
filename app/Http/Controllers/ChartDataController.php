<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ChartDataController extends Controller
{
    // print data
    public function getPrintChartData()
    {
        Log::info('Session usertype_id: ' . session('usertype_id'));
        Log::info('Session station_id: ' . session('station_id'));

        $stationColumn = match (session('usertype_id')) {
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
            ->select(['qty', 'subject_shorcode', 'population', 'grade_level'])
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
                'subject_shorcode',
                DB::raw('(COALESCE(SUM(qty), 0) - COALESCE(population, 0)) AS exdef'),
                DB::raw('COALESCE(SUM(qty), 0) AS qty'),
                'population',
                DB::raw('CASE WHEN COALESCE(population, 0) = 0 THEN NULL ELSE (COALESCE(SUM(qty), 0) / COALESCE(population, 0)) END AS ratio')
            )
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->groupBy('grade_level', 'subject_shorcode', 'population')
            ->get();

        $heatmapData = DB::table('datatable_print')
            ->select('grade_level', 'subject_shorcode', 'qty')
            ->where($stationColumn, $stationId)
            ->where('status', $status)
            ->groupBy('grade_level', 'subject_shorcode', 'qty')
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
        $stationType = match (session('usertype_id')) {
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
    
}
