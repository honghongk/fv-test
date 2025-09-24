<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// 로그인으로 이동
Route::get('/', function () {
    return redirect('/login');
});

// 로그인 폼
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// 로그인 처리
Route::post('/login', [AuthController::class, 'login']);

// 로그아웃
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout']);
