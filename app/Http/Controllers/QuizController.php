<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    // クイズ一覧
    public function index()
    {
        return view('quizzes.index');
    }

    // クイズ作成フォーム
    public function create()
    {
        return view('quizzes.create');
    }

    // クイズ保存処理
    public function store(Request $request)
    {
        // TODO: バリデーションや保存処理
        return redirect()->route('quizzes.index');
    }
}
