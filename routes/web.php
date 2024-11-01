<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [ClienteController::class, 'index2'])->name('principal');

Route::get('/login', function () {
    return view('admin.template_admin.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/registrar', function () {
    return view('admin.template_admin.registrar');
});
Route::post('/registrar', [AuthController::class, 'registrar']);

Route::middleware([AdminMiddleware::class])->group(function () {

        Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
        Route::post('/estoque', [EstoqueController::class, 'SalvarNovaR'])->name('estoque.salvar');
        Route::post('/estoque/upd', [EstoqueController::class, 'edit'])->name('estoque.editar');
        Route::delete('/estoque/{id}', [EstoqueController::class, 'destroy'])->name('est_excluir');

    
    
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::post('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas');
    Route::post('/reservas/upd/{id}', [ReservasController::class, 'update'])->name('reservas.upd');
    Route::delete('/reservas/dlt/{id}', [ReservasController::class, 'destroy'])->name('reservas.destroy');
    Route::resource('reservas', ReservasController::class);
});

Route::post('/clientes', [ClienteController::class, 'SalvarCliente'])->name('clientes.salvar');
Route::post('/detalhes/{id}', [EstoqueController::class, 'infoRoupas'])->name('roupa.mostrar');
