<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\RiderController;
use App\Models\User;

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

Route::prefix("auth")->group(function(){
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('login', [LoginController::class, 'store']);
});



Route::group(["middleware" => ["auth:sanctum"],  "prefix" => "percels"],function(){
    Route::get('/',[ParcelController::class,'index']);
    Route::get('/{parcel}',[ParcelController::class,'get']);
    Route::post('/create', [ParcelController::class,'create']);
   
});


Route::group(["middleware" => ["auth:sanctum", 'role:'.User::USER_ROLE_RIDER ], "prefix" => "rider"],function(){
    Route::get('/parcels',[RiderController::class,'myParcels']);
    Route::get('/parcels/available',[RiderController::class,'get']);
    Route::post('/parcels/{parcel}/pick',[ParcelController::class,'pickParcel']);
});
