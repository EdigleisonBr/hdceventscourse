<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Cagartner\CorreiosConsulta\ServiceProvider;
use Canducci\Cep\Providers\CepServiceProvider;

// Importando Controllers

use App\Http\Controllers\EventController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CepController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
Route::get('/', [EventController::class, 'index']);

Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
// edit: Edita / update: insere a alteração no banco
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
// Usuários participantes dos eventos
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');

// Sair do evento
Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

Route::get('/users/create', [UserController::class, 'create'])->middleware('auth');

Route::get('/crud_index', [CrudController::class, 'index']);
Route::get('/crud_create', [CrudController::class, 'create']);
Route::get('/crud_store', [CrudController::class, 'store']);

Route::get('/valida-nome', [EventController::class, 'validaNome']);

Route::get('/addresses/create', [EventController::class, 'createAddress']);

/*
|--------------------------------------------------------------------------
| Pacotes Busca CEP
|--------------------------------------------------------------------------
|   Rota de Providers de busca de CEP via API
*/

// Route::get('/cep/{cep}', 'CepController@buscaPorCep');

// package:: canducci/cep
Route::get('/busca-cep', [CepController::class, 'buscaPorCep']);

// package:: cagartner-correios-consulta
Route::get('/buscacep', [CepController::class, 'buscaCep']);










