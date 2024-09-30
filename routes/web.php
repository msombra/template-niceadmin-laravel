<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ControleAcordoController;

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

// AUTH
Route::controller(AuthController::class)->group(function() {
    // register
    Route::get('/register', 'register')->name('auth.register');
    Route::post('/register', 'registerPost')->name('auth.register');
    // login
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login', 'loginPost')->name('auth.login');
    // definição senha
    Route::get('/set_password/{email}', 'setPassword')->name('auth.set_password');
    Route::post('/create_password', 'createPassword')->name('auth.create_password');
    // redefinição senha
    Route::get('/reset_password', 'resetPassword')->name('auth.reset_password');
    Route::post('/reset_password', 'resetPasswordPost')->name('auth.reset_password');
});

Route::group(['middleware' => 'auth'], function() {
    // Home Page
    Route::view('/', 'pages.index')->name('index');

    // DRC
    Route::controller(ControleAcordoController::class)->group(function() {
        // list
        Route::get('/drc_list', 'list')->name('drc.list');
        // create
        Route::get('/drc_create', 'create')->name('drc.create');
        Route::post('/drc_store', 'store')->name('drc.store');
        // update
        Route::get('/drc_edit/{id}', 'edit')->name('drc.edit');
        Route::post('/drc_update/{id}', 'update')->name('drc.update');
        // show
        Route::get('/drc_show/{id}', 'show')->name('drc.show');
        // delete
        Route::delete('/drc_destroy/{id}', 'destroy')->name('drc.destroy');
        // export
        Route::get('/drc_export', 'export')->name('drc.export');
    });

    // DRC - Mini-Crud Contratos
    Route::controller(ContratoController::class)->group(function() {
        Route::get('/contrato_list', 'list')->name('contrato.list');
        Route::post('/contrato_store', 'store')->name('contrato.store');
        Route::post('/contrato_update', 'update')->name('contrato.update');
        Route::post('/contrato_destroy', 'destroy')->name('contrato.destroy');
    });

    // Gerenciador Usuários
    Route::controller(UserController::class)->group(function() {
        Route::get('/users', 'index')->name('user.index');
        // create
        Route::get('/user_create', 'create')->name('user.create');
        Route::post('/user_store', 'store')->name('user.store');
        // update
        Route::get('/user_edit/{id}', 'edit')->name('user.edit');
        Route::post('/user_update/{id}', 'update')->name('user.update');
        // delete
        Route::delete('/user_destroy/{id}', 'destroy')->name('user.destroy');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

