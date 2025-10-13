<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    QuizController,
    PlayController,
    ScoreController,
    ProfileController
};

// 認証済みユーザーのみアクセス可
Route::middleware(['auth', 'verified'])->group(function () {

    // ホーム画面
   // ホーム画面（dashboard でも同じビューを返す）
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // クイズ作成・管理
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

    // クイズプレイ
    Route::get('/play/{quiz}', [PlayController::class, 'index'])->name('play.index');
    Route::post('/play/{quiz}', [PlayController::class, 'submit'])->name('play.submit');

    // スコア
    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');

    // プロフィール
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
