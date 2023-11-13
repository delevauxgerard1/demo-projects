<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Livewire\Cliente\IndexCliente;
use App\Http\Livewire\IndexProyectos;
use App\Http\Livewire\IndexReportes;
use App\Http\Livewire\Proyecto\IndexClientesProyectos;

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

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');
    Route::get('/dashboard', IndexCliente::class)->name('dashboard');
    Route::get('/proyectos', IndexProyectos::class)->name('proyectos');
    Route::get('/reportes', IndexReportes::class)->name('reportes');
    Route::get('/cliente/proyectos/{clienteid}', IndexClientesProyectos::class)->name('clientes.proyectos');
    Route::get('/cliente/proyectos/{clienteid}/{proyectoid}', IndexClientesProyectos::class)->name('clientes.proyectosid');
    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});