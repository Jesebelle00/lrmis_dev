<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewResourceController extends Controller
{
    public function show($id)
    {
        $resource = DB::table('datatable_print')->where('lr_id', $id)->first();

        if (!$resource) {
            return redirect()->back()->with('error', 'Resource not found.');
        }
        return view('pages.view-resource-print', compact('resource'));
    }

    public function showNonPrint($id)
    {
        $resource = DB::table('datatable_non_print')->where('lr_id', $id)->first();

        if (!$resource) {
            return redirect()->back()->with('error', 'Resource not found.');
        }
        return view('pages.view-resource-nonprint', compact('resource'));
    }
}
