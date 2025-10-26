<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Category;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with('category')->get();
        return view('quizzes-management.index',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // categories テーブルから name と id を取得（id => name の形）
    $categories = Category::pluck('name', 'id');
        return view('quizzes-management.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
    'title' => 'required|string|max:255',             // クイズ名
    'category_id' => 'nullable|integer',              // カテゴリ
    'questions' => 'required|array|min:1',            // 1問以上
    'questions.*.question' => 'required|string',      // 各問題の問題文
    'questions.*.choices' => 'required|array|min:2', // 各問題の選択肢（2つ以上）
    'questions.*.answer' => 'required|integer',       // 各問題の正解番号
]);

// Quizタイトルだけ作成（ループの外に出す！）
$quiz = Quiz::create([
    'title' => $request->title,
    'category_id' => $request->category_id ?: null,
]);

        foreach ($request->questions as $q) {
    // 空欄選択肢を除外
    $choices = array_values(array_filter($q['choices'], fn($c) => trim($c) !== ''));

    // 選択肢が2つ未満ならバリデーションエラー
    if(count($choices) < 2){
        return back()->withErrors(['questions' => '各問題には2つ以上の選択肢が必要です。'])->withInput();
    }
        }
        // 複数問題をまとめて作成
        foreach ($request->questions as $q) {
            $quiz->questions()->create([
                'question' => $q['question'],
                'choices' => $choices,
                'answer' => $q['answer'],
            ]);
        }
        return redirect()->route('quizzes-management.index')->with('success', 'クイズを登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
     // $quiz に紐づく全ての questions を処理
    foreach ($quiz->questions as $question)
       {if (is_string($question->choices)) {
            $question->choices = json_decode($question->choices, true);
        }
        // null の場合は空配列に
        $question->choices = $question->choices ?? [];
    }
    return view('quizzes-management.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $categories = Category::pluck('name', 'id'); // ← これに変更
        return view('quizzes-management.edit', compact('quiz','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
         $request->validate([
            'title' => 'required|string|max:255',
    'category_id' => 'nullable|integer',
    'questions' => 'required|array|min:1',
    'questions.*.question' => 'required|string',
    'questions.*.choices' => 'required|array|min:2',
    'questions.*.answer' => 'required|integer',
        ]);

        // Quizタイトル更新
        $quiz->update([
            'title' => $request->title,
            'category_id' => $request->category_id ?: null,
        ]);

        // 既存問題を全削除して新しい問題で上書き（簡単なやり方）
        $quiz->questions()->delete();
        foreach ($request->questions as $q) {
    $choices = array_values(array_filter($q['choices'], fn($c) => trim($c) !== ''));
    if(count($choices) < 2){
        return back()->withErrors(['questions' => '各問題には2つ以上の選択肢が必要です。'])->withInput();
    }
            $quiz->questions()->create([
                'question' => $q['question'],
                'choices' => $q['choices'],
                'answer' => $q['answer'],
            ]);
        }
        return redirect()->route('quizzes-management.index')->with('success', 'クイズを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes-management.index')->with('success', 'クイズを削除しました。');
    }/**
     * ✅ 新しく追加：タイトルだけを更新するルート用
     */
    public function updateTitle(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->title = $request->input('title');
        $quiz->save();

        return back()->with('success', 'クイズ名を更新しました！');
    }
}