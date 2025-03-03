<?php

use App\Http\Controllers\MidtransController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/generateSymmetricSignature", [MidtransController::class, 'generateSymmetricSignature']);
Route::post("/generateAsymmetricSignature", [MidtransController::class, 'generateAsymmetricSignature']);
Route::post("/getB2BToken", [MidtransController::class, 'getB2BToken']);
Route::post("/generateQris", [MidtransController::class, 'generateQris']);
Route::post("/checkStatus", [MidtransController::class, 'checkStatus']);
