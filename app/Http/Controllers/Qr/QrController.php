<?php

namespace App\Http\Controllers\Qr;

use App\Http\Controllers\Controller;
use App\Models\LR;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    //
    public function index(){

        $LrList = LR::take(100)->with(  "typeName", "title")->get();
        return view("qr/lr-view", ['LrList' => $LrList]);
    }

    public function show($id)
    {
        // Find the lr by id
        $lr = LR::with("typeName", "title")->findOrFail($id);

        $qrCode = QrCode::size(100)->generate(route('lr.show', $lr->id));

        // Return the 'lr.show' view with the items data
        return view('qr/lr-show', compact('lr', 'qrCode'));
    }



}
