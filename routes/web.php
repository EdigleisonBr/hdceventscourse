<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;


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

// Importando Controllers

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

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

Route::get('/contact', function () {
    //Alert::success('Success Title', 'Success Message');
    //alert()->info('Title','Lorem Lorem Lorem');
    toast('Your Post as been submited!','success');
    // swal({
    //     title: "Good job!",
    //     text: "You clicked the button!",
    //     icon: "success",
    //   });

    return view('contact');
});


