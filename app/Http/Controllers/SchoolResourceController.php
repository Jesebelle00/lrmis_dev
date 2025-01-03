<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolResourceController extends Controller
{
    public function index()
    {
        return view('pages.school-resource');
    }

    public function getPrintResources(Request $request)
    {
        $columns = [
            0 => 'lr_id',
            1 => 'title',
            2 => 'type_name',
            3 => 'subject_title',
            4 => 'grade_level',
            5 => 'volume',
            6 => 'copyrightyear',
            7 => 'pages',
            8 => 'qty',
            DB::raw("'' as actions")
        ];

        $query = DB::table('datatable_print')
            ->where('station_type_code', '=', 'SCH');

        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('lr_id', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('type_name', 'like', "%{$search}%")
                    ->orWhere('subject_title', 'like', "%{$search}%")
                    ->orWhere('grade_level', 'like', "%{$search}%")
                    ->orWhere('volume', 'like', "%{$search}%")
                    ->orWhere('copyrightyear', 'like', "%{$search}%")
                    ->orWhere('pages', 'like', "%{$search}%");
            });
        }

        $order = $request->input('order');
        $columnIndex = $order[0]['column'] ?? 0;
        $columnIndex = array_key_exists($columnIndex, $columns) ? $columnIndex : 0;
        $columnDir = $order[0]['dir'] === 'desc' ? 'desc' : 'asc';
        $query->orderBy($columns[$columnIndex], $columnDir);

        $start = max(0, $request->input('start', 0));
        $length = max(1, $request->input('length', 10));

        $totalData = DB::table('datatable_print')
            ->where('station_type_code', '=', 'SCH')
            ->count();
        $totalFiltered = (clone $query)->count();

        $data = $query->offset($start)
            ->limit($length)
            ->select([
                'lr_id',
                'title',
                'type_name',
                'subject_title',
                'grade_level',
                'volume',
                'copyrightyear',
                'pages',
                'qty',
            ])
            ->get();

        return response()->json([
            'draw' => (int) $request->input('draw', 1),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function getNonPrintResources(Request $request)
    {
        $columns = [
            0 => 'lr_id',
            1 => 'type_name',
            2 => 'subject_title',
            3 => 'grade_level',
            4 => 'size',
            5 => 'model',
            6 => 'url',
            7 => 'qty',
            8 => DB::raw("'' as actions"), // Add actions column
        ];

        $query = DB::table('datatable_non_print')
            ->where('station_type_code', '=', 'SCH');

        // Handling search functionality
        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('lr_id', 'like', "%{$search}%")
                    ->orWhere('type_name', 'like', "%{$search}%")
                    ->orWhere('subject_title', 'like', "%{$search}%")
                    ->orWhere('grade_level', 'like', "%{$search}%")
                    ->orWhere('size', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('url', 'like', "%{$search}%");
            });
        }

        // Sorting logic
        $order = $request->input('order');
        $columnIndex = $order[0]['column'] ?? 0;
        $columnIndex = array_key_exists($columnIndex, $columns) ? $columnIndex : 0;
        $columnDir = $order[0]['dir'] === 'desc' ? 'desc' : 'asc';
        $query->orderBy($columns[$columnIndex], $columnDir);

        // Pagination logic
        $start = max(0, $request->input('start', 0));
        $length = max(1, $request->input('length', 10));

        // Total records count
        $totalData = DB::table('datatable_non_print')
            ->where('station_type_code', '=', 'SCH')
            ->count();

        // Filtered records count
        $totalFiltered = $query->count();

        // Get data for current page
        $data = $query->offset($start)
            ->limit($length)
            ->select([
                'lr_id',
                'type_name',
                'subject_title',
                'grade_level',
                'size',
                'model',
                'url',
                'qty',
                DB::raw("'' as actions"), // Include actions column in the query
            ])
            ->get();

        return response()->json([
            'draw' => (int) $request->input('draw', 1),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

}
