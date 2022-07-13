<?php

use App\Http\Controllers\GetPatientController;
use App\Http\Controllers\GetPatientDetailController;
use App\Http\Controllers\ListPatientController;
use App\Http\Controllers\NewPatientController;
use App\Http\Controllers\UpdatePatientController;
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

Route::get('/patient/{user}', GetPatientController::class);
Route::get('/patients', ListPatientController::class);

Route::post('/patient', NewPatientController::class);
Route::put('/patient/{user}', UpdatePatientController::class);
Route::get('/patientDetail/{user}', GetPatientDetailController::class);
