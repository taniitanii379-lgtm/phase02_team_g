<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    PlayController,
    QuizController,
    ScoreController,
    ProfileController
};

// 認証済みユーザーのみアクセス可
Route::middleware(['auth', 'verified'])->group(function () {
    
    // ホーム画面
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // クイズ一覧
    Route::get('/quizzes', [PlayController::class, 'index'])->name('quizzes.index');
    
    // 個別クイズプレイ
    Route::get('/play/{quiz}', [PlayController::class, 'show'])->name('play.show'); 
    Route::post('/play/{quiz}', [PlayController::class, 'answer'])->name('play.answer'); 
    Route::get('/play/{quiz}/result', [PlayController::class, 'result'])->name('play.result'); 

    // スコア履歴
    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');

    // プロフィール
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // クイズ管理
    Route::resource('quizzes-management', QuizController::class)
        ->parameters(['quizzes-management' => 'quiz']);
    Route::patch('/quizzes/{id}/update-title', [QuizController::class, 'updateTitle'])
        ->name('quizzes.updateTitle');
});

require __DIR__ . '/auth.php';