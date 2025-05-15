<?php

use App\Http\Controllers\RfidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('rfid/reads', [RfidController::class, 'read'])->name('epc.read');
