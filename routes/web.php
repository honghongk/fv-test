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

// auth 기본 미들웨어는 ->name('login') 인 라우트 필수
Route::middleware('auth')->group(function () {
    
    // 목록
    Route::get('/posts', [PostController::class, 'list'])->name('posts.list');

    // 생성폼
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    // 상세
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    // 저장처리
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // 수정폼
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

    // 수정처리
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

    // 삭제처리
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});