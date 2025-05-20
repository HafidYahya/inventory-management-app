<?php

namespace App\Http\Controllers;

use App\Events\RfidTagScanned;
use App\Models\AssetRegistered;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    public function read(Request $request){

        event(new RfidTagScanned($request->epc));

        if(AssetRegistered::where('epc', $request->epc)->exists()){
            return response()->json([
            'message' => 'RFID Already Exists',
            'code' => 'EXISTS',
            'epc' => $request->input('epc')
        ]);
        }else{
            return response()->json([
            'message' => 'RFID Read Successfully',
            'code' => 'SUCCESS',
            'epc' => $request->input('epc')
        ]);
        }
    }
}
