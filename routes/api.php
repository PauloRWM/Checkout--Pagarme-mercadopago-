<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PixController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\pixStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/pagamentoPix', [PixController::class, 'pixGet']);
Route::post('/pagamentoPix', [PixController::class, 'pixGet']);
Route::post('/webhook', [WebhookController::class, 'activePlan']);
Route::get('/pixstatus/{ordem}', [pixStatusController::class, 'index']);
