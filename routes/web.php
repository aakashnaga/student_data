<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return view('register');
});

Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']); 
Route::get('/users/{id}/edit', [UserController::class, 'edit']); 
Route::post('/users/{id}/update', [UserController::class, 'update']);
Route::post('/users/{id}/delete', [UserController::class, 'destroy']);


