<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TelegramBotController;

Route::get('/', [ClienteController::class, 'index2'])->name('principal');

Route::post('/clientes', [ClienteController::class, 'SalvarCliente'])->name('clientes.salvar');
Route::post('/detalhes/{id}', [EstoqueController::class, 'infoRoupas'])->name('roupa.mostrar');

Route::middleware('auth')->group(function () {

    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index'); 
    Route::post('/estoque', [EstoqueController::class, 'SalvarNovaR'])->name('estoque.store');
    Route::get('/estoque/{id}', [EstoqueController::class, 'buscar'])->name('estoque.edit');
    Route::put('/estoque/{id}', [EstoqueController::class, 'edit'])->name('estoque.update');
    Route::delete('/estoque/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');

    // Route::post('/reservar', [TelegramBotController::class, 'reservar'])->name('reservar');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::post('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/toggle-permission/{user}', [AdminController::class, 'togglePermission'])->name('admin.togglePermission');

    Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');
    Route::post('/reservas/upd/{id}', [ReservasController::class, 'update'])->name('reservas.upd');
    Route::delete('/reservas/dlt/{id}', [ReservasController::class, 'destroy'])->name('reservas.destroy');
});

Route::get('/login', function () {
    return view('admin.template_admin.login');
});
Route::get('/registrar', function () {
    return view('admin.template_admin.registrar');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/registrar', [AuthController::class, 'registrar']);
