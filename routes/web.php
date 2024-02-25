<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\pageAtendimentoController;
use App\Http\Controllers\iaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/plataforma_atendimento/{planoid}/{company}/{email}',[pageAtendimentoController::class, 'index']);
Route::get('/ia/',[iaController::class, 'index']);

Route::post('/pagamento', [PagamentoController::class, 'index']);
