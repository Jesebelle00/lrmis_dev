<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StationProfileController extends Controller
{
    public function getData(Request $request)
    {
        // Base Query without Filters
        $baseQuery = DB::table('school_users_station')
            ->select(
                'station_id',
                'school_name',
                'district_name',
                'division_name',
                'region_name'
            )
            ->distinct()
            ->where('division', '=', session('station_id'));

        // Get Total Records (before filtering)
        $totalRecords = $baseQuery->count();

        // Clone Query for Filtering and Pagination
        $filteredQuery = clone $baseQuery;

        // Apply Search Filter
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $filteredQuery->where(function ($subQuery) use ($searchValue) {
                $subQuery->where('school_name', 'like', "%$searchValue%")
                         ->orWhere('district_name', 'like', "%$searchValue%")
                         ->orWhere('division_name', 'like', "%$searchValue%");
            });
        }

        // Get Filtered Records Count
        $recordsFiltered = $filteredQuery->count();

        // Apply Pagination
        if ($request->has('start') && $request->has('length')) {
            $filteredQuery->offset($request->start)->limit($request->length);
        }

        // Apply Ordering
        if ($request->has('order')) {
            $columns = [
                'school_name',
                'district_name',
                'division_name',
                'region_name'
            ];
            $orderColumn = $columns[$request->order[0]['column']] ?? 'station_id';
            $orderDir = $request->order[0]['dir'] ?? 'asc';
            $filteredQuery->orderBy($orderColumn, $orderDir);
        }

        // Fetch Paginated Data
        $data = $filteredQuery->get()->map(function ($item) {
            $item->actions = '
                <button class="btn btn-warning btn-sm" onclick="editStation(' . e($item->station_id) . ')">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteStation(' . e($item->station_id) . ')">Delete</button>
            ';
            return $item;
        });

        // Return Response
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

}

