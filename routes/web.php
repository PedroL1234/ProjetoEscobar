<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('principal.index');
});
Route::get('/estoque', function () {
    return view('principal.estoque');
});
Route::get('/vitrine', function () {
    return view('principal.vitrine');
});
Route::get('/reservas', function () {
    return view('principal.reservas');
});
Route::get('/promocoes', function () {
    return view('principal.promocoes');
});


