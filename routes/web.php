<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('quizzes', QuizController::class);