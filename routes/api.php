<?php

use App\Http\Controllers\usuariocontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [usuariocontroller::class, 'login']);
Route::post('/registrar', [usuariocontroller::class, 'registrar']);
Route::post('/recuperar', [usuariocontroller::class, 'recuperar']);

Route::get('/usuario/{id}', [usuariocontroller::class, 'mostrar']);
Route::get('/usuarios', [usuariocontroller::class, 'listado']);