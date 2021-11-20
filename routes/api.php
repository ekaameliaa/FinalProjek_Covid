<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
#import patientcontrollet
use App\Http\Controllers\PatientController;

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

#route get endpoint patients
Route::get('/patients', [PatientController::class, 'index']);

#route post endpoint patients
Route::post('/patients', [PatientController::class, 'store']);

#route get endpoint ppatients
Route::get('/patients/{id}', [PatientController::class, 'show']);

#route put endpoint patients
Route::put('/patients/{id}', [PatientController::class, 'update']);

#route delete endpoint patients
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

Route::get('/patients/search/{name}', [PatientController::class, 'search']);

Route::get('/patients/status/positive', [PatientController::class, 'positive']);

Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);

Route::get('/patients/status/dead', [PatientController::class, 'dead']);