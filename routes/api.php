<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


// 토큰 발급
Route::post('/token', [AuthController::class, 'issueToken']);

// auth 기본 미들웨어는 ->name('login') 인 라우트 필수
Route::middleware('auth:api')->group(function () {
    
    // 목록
    Route::get('/posts', [PostController::class, 'list']);

    // 상세
    Route::get('/posts/{id}', [PostController::class, 'show']);

    // 저장처리
    Route::post('/posts', [PostController::class, 'store']);

    // 수정처리
    Route::put('/posts/{id}', [PostController::class, 'update']);

    // 삭제처리
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    // 댓글
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});