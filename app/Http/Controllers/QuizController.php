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
            'question' => 'required|string',
            'choices' => 'required|array|min:2',
            'answer' => 'required|integer',
            'category_id' => 'nullable|integer',
            'title' => 'required|string|max:255', // ✅ タイトルも追加
        ]);

        Quiz::create([
            'title' => $request->title, // ✅ 追加
            'question' => $request->question,
            'choices' => $request->choices,
            'answer' => $request->answer,
            'category_id' => $request->category_id ?: null,
        ]);

        return redirect()->route('quizzes-management.index')->with('success', 'クイズを登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        // choices が JSON で保存されているので配列に変換
    $quiz->choices = json_decode($quiz->choices, true);

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
            'question' => 'required|string',
            'choices' => 'required|array|min:2',
            'answer' => 'required|integer',
            'title' => 'nullable|string|max:255', // ✅ 追加
        ]);

        $quiz->update([
            'title' => $request->title, // ✅ 追加
            'question' => $request->question,
            'choices' => $request->choices,
            'answer' => $request->answer,
            'category_id' => $request->category_id ?: null, // 追加
        ]);

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