<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControleAcordoController;
use App\Http\Controllers\ContratoController;

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
// Mini-Crud Contratos
Route::controller(ContratoController::class)->group(function() {
    Route::get('/contrato_list', 'list')->name('contrato.list');
    Route::post('/contrato_store', 'store')->name('contrato.store');
    Route::post('/contrato_update', 'update')->name('contrato.update');
    Route::post('/contrato_destroy', 'destroy')->name('contrato.destroy');
});
