<?php

namespace App\Http\Controllers\Qr;

use App\Http\Controllers\Controller;
use App\Models\LR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    //
    public function index(){
/*
        $LrList = LR::take(100)->with(  "typeName", "title")->get(); */
        $data = DB::table('datatable_print')->get();
        return view("qr/lr-view", ['data' => $data]);
    }

    public function show($id)
    {
        // Find the lr by id
        $lr = DB::table('datatable_print')->where('lr_id', $id)->firstOrFail();

        $qrCode = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . route('lr.show', $lr->lr_id);

       /*  $qrCode = QrCode::size(150)->generate(route('lr.show', $lr->lr_id)); */

        // Return the 'lr.show' view with the items data
        return view('qr/lr-show', compact('lr', 'qrCode'));
    }

    public function showQRCode(Request $request)
    {
        // Get the 'id' from the query string
        $id = $request->query('id');

        // Generate the QR code URL using the route
        $qrCodeURL = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . route('lr.show', $id);

        // Return the QR code URL as JSON response
        return response()->json([
            'qr_code_url' => $qrCodeURL
        ]);

    }


}
