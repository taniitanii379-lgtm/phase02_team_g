<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    PlayController, // PlayControllerを使用
    QuizController,
    ScoreController,
    ProfileController
};

// 認証済みユーザーのみアクセス可
Route::middleware(['auth', 'verified'])->group(function () {
    
    // ホーム画面
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // クイズ一覧 (PlayController@index が担当)
    Route::get('/quizzes', [PlayController::class, 'index'])->name('quizzes.index');
    
    // 個別クイズプレイ画面 (PlayController@show が担当)
    Route::get('/play/{quiz}', [PlayController::class, 'show'])->name('play.show'); 
    Route::post('/play/{quiz}', [PlayController::class, 'submit'])->name('play.submit');

    // スコア (QuizControllerのルートを削除し、PlayControllerに集約しました)
    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
    //スコア履歴表示
    Route::middleware(['auth'])->group(function () {
    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
   });

    // プロフィール
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // routes/web.php - 修正後のクイズプレイ関連ルートブロック

// ... (省略) ...

    // 個別クイズプレイ画面 (PlayController@show が担当)
    Route::get('/play/{quiz}', [PlayController::class, 'show'])->name('play.show'); 

    // 問題の回答処理と次の問題への遷移
    Route::post('/play/{quiz}', [PlayController::class, 'answer'])->name('play.answer'); 

    // 結果表示 (新設)
    Route::get('/play/{quiz}/result', [PlayController::class, 'result'])->name('play.result'); 

// ... (省略) ... 
    
    // クイズ管理用ルート（QuizController）
    Route::resource('quizzes-management', QuizController::class)->parameters(['quizzes-management' => 'quiz']);
    Route::patch('/quizzes/{id}/update-title', [QuizController::class, 'updateTitle'])
    ->name('quizzes.updateTitle');




});

require __DIR__ . '/auth.php';
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile.show');

