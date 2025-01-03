<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function getData(Request $request)
    {
        $query = DB::table('school_users_station')
            ->select(
                'station_id',
                'username',
                'user_type_name',
                'school_name',
                'district_name',
                'division_name',
                'region_name',
                'user_status_name'
            )
            ->where('division', '=', session('station_id'));

        // Get Total Records (before filtering)
        $totalRecords = $query->count();

        // Apply Search Filter
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query->where(function ($subQuery) use ($searchValue) {
                $subQuery->where('username', 'like', "%$searchValue%")
                        ->orWhere('user_type_name', 'like', "%$searchValue%")
                        ->orWhere('school_name', 'like', "%$searchValue%");
            });
        }

        // Get Filtered Records Count
        $recordsFiltered = $query->count();

        // Apply Pagination
        if ($request->has('start') && $request->has('length')) {
            $query->offset($request->start)->limit($request->length);
        }

        // Apply Ordering
        if ($request->has('order')) {
            $columns = [
                'username',
                'user_type_name',
                'school_name',
                'district_name',
                'division_name',
                'region_name',
            ];
            $orderColumn = $columns[$request->order[0]['column']] ?? 'station_id';
            $orderDir = $request->order[0]['dir'] ?? 'asc';
            $query->orderBy($orderColumn, $orderDir);
        }

        // Fetch Paginated Data
        $data = $query->get();

        $data = $data->map(function ($item) {
            $actions = '';

            // Conditional logic for user status
            if ($item->user_status_name == 'Active') {
                $actions = '
                    <button class="btn btn-warning btn-sm" onclick="editUser(' . e($item->station_id) . ')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser(' . e($item->station_id) . ')">Delete</button>
                    <button class="btn btn-danger btn-sm" onclick="toggleStatus(' . e($item->station_id) . ')">Deactivate</button>
                ';
            } elseif ($item->user_status_name == 'Pending') {
                $actions = '
                    <button class="btn btn-warning btn-sm" onclick="editUser(' . e($item->station_id) . ')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser(' . e($item->station_id) . ')">Delete</button>
                    <button class="btn btn-success btn-sm" onclick="approveUser(' . e($item->station_id) . ')">Approve</button>
                ';
            } elseif ($item->user_status_name == 'Deactivated') {
                $actions = '
                    <button class="btn btn-warning btn-sm" onclick="editUser(' . e($item->station_id) . ')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser(' . e($item->station_id) . ')">Delete</button>
                    <button class="btn btn-primary btn-sm" onclick="toggleStatus(' . e($item->station_id) . ')">Activate</button>
                ';
            }

            $item->actions = $actions;
            return $item;
        })->toArray();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

}
