<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Livewire\Cliente\IndexCliente;
use App\Http\Livewire\IndexProyectos;
use App\Http\Livewire\IndexReportes;
use App\Http\Livewire\Proyecto\IndexClientesProyectos;
use App\Http\Controllers\FacturaController;

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/clientes', IndexCliente::class)->name('dashboard');
    Route::get('/proyectos', IndexProyectos::class)->name('proyectos');
    Route::get('/reportes', IndexReportes::class)->name('reportes');
    Route::get('/cliente/proyectos/{clienteid}', IndexClientesProyectos::class)->name('clientes.proyectos');
    Route::get('/cliente/proyectos/{clienteid}/{proyectoid?}', IndexClientesProyectos::class)->name('clientes.proyectosid');
    Route::get('/generar-factura/{proyectoId}', [FacturaController::class, 'generarFacturaPDF']);
    Route::fallback(function() {
        return view('pages/utility/404');
    });
    
    /* Estas son las rutas y estoy probando este comentario para github */
});