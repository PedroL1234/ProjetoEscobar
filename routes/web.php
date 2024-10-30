<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\AuthController;

Route::get('/', [ClienteController::class, 'index'])->name('principal');

Route::get('/login',function(){
    return view ("admin.template_admin.login");
});

Route::post('/clientes', [ClienteController::class, 'SalvarCliente'])->name('clientes.salvar');


Route::middleware('auth')->group(function(){

    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque');

    Route::post('/estoque-categoria', [EstoqueController::class, 'SalvarNovaR'])->name('roupa.salvar');
    Route::get('/estoque/{id}', [EstoqueController::class, 'est_alterar'])->name('est_alterar');
    Route::delete('/estoque/{id}', [EstoqueController::class, 'est_excluir'])->name('est_excluir');

});

Route::get('/login', function(){
    return view('admin.template_admin.login');
});

Route::get('/registrar', function(){
    return view('admin.template_admin.registrar');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/registrar', [AuthController::class, 'registrar']);




