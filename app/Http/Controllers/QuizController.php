<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizzes.create');
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
        ]);

        Quiz::create([
            'question' => $request->question,
            'choices' => json_encode($request->choices),
            'answer' => $request->answer,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'クイズを登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
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
        ]);

        $quiz->update([
            'question' => $request->question,
            'choices' => json_encode($request->choices),
            'answer' => $request->answer,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'クイズを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'クイズを削除しました。');
    }
}
