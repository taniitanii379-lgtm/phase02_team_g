<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\BadgeService;

class PlayController extends Controller
{
    /**
     * クイズ一覧（タイトル一覧）を表示する (GET /quizzes)
     */
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->get();
        return view('quizzes.play', compact('quizzes'));
    }

    /**
     * クイズ回答送信 (POST /quizzes/{quizId}/submit)
     */
    public function submit(Request $request, $quizId, BadgeService $badgeService)
    {
        $user = Auth::user();

        $badgeService->awardBadges($user);

        return redirect()->route('home')->with('status', 'クイズを送信しました');
    }

    /**
     * クイズプレイ画面を開始し、1問目を表示 (GET /play/{quiz})
     */
    public function show(Quiz $quiz)
    {
        // 1. セッションの初期化と準備
        $quiz->load('questions');
        
        // 全問題をランダムにシャッフルし、最大10問に制限する
        // 全問題を取得 -> シャッフル -> 10件まで取得
        $allQuestions = $quiz->questions->shuffle()->take(10); 

        // 全問題のIDと、現在の状態をセッションに保存
        Session::put('quiz_id', $quiz->id);
        Session::put('question_ids', $allQuestions->pluck('id')->toArray()); // 10問以下のIDリスト
        Session::put('current_index', 0);
        Session::put('user_answers', []); // 回答履歴

        // 2. 最初の問題を取得
        $currentQuestion = $allQuestions->first();
        $totalQuestions = $allQuestions->count();
        
        // 問題がなければエラーを防ぐ
        if (!$currentQuestion) {
            return redirect()->route('quizzes.index')->withErrors(['error' => 'このクイズには問題がありません。']);
        }
        
        return view('play.index', compact('quiz', 'currentQuestion', 'totalQuestions'));
    }

    /**
     * 回答処理と次の問題への遷移 (POST /play/{quiz})
     */
    public function answer(Request $request, Quiz $quiz)
    {
        // 1. セッションから状態を取得
        $questionIds = Session::get('question_ids');
        $currentIndex = Session::get('current_index');
        $userAnswers = Session::get('user_answers');
        
        // セッション切れ対策
        if (!$questionIds || $currentIndex === null) {
             return redirect()->route('quizzes.index');
        }

        // 2. 現在の問題のIDとユーザーの回答を取得
        $currentQuestionId = $questionIds[$currentIndex];
        $userAnswer = (int)$request->input('answer');

        // 3. 回答をセッションに記録
        $userAnswers[$currentQuestionId] = $userAnswer;
        Session::put('user_answers', $userAnswers);

        // 4. 次の問題へインデックスを進める
        $newIndex = $currentIndex + 1;
        Session::put('current_index', $newIndex); // インデックスを更新

        if ($newIndex < count($questionIds)) {
            // 次の問題がある場合
            
            // 次の問題を取得
            $nextQuestionId = $questionIds[$newIndex];
            $nextQuestion = $quiz->questions()->find($nextQuestionId);
            $totalQuestions = count($questionIds);
            
            return view('play.index', [
                'quiz' => $quiz, 
                'currentQuestion' => $nextQuestion, 
                'totalQuestions' => $totalQuestions
            ]);

        } else {
            // すべての問題が終了した場合
            return redirect()->route('play.result', $quiz);
        }
    }

    /**
     * 最終結果の表示 (GET /play/{quiz}/result)
     */
    public function result(Quiz $quiz)
    {
        $quiz->load('questions');
        $userAnswers = Session::get('user_answers', []);

        $score = 0;
        $total = count(Session::get('question_ids', [])); // 出題された問題数
        $results = [];

        // 出題されたIDのみを対象に結果を計算する
        foreach (Session::get('question_ids', []) as $questionId) {
            $question = $quiz->questions->where('id', $questionId)->first();
            
            if (!$question) continue;

            $correctAnswer = (int)$question->answer;
            $userAnswer = $userAnswers[$question->id] ?? null;
            $isCorrect = ($userAnswer !== null && $userAnswer === $correctAnswer);

            if ($isCorrect) {
                $score++;
            }
            // 結果表示用に詳細情報を格納
            $results[] = [
                'question' => $question->question,
                'correct' => $correctAnswer,
                'user' => $userAnswer,
                'is_correct' => $isCorrect,
            ];
        }

        // セッションをクリア
        Session::forget(['quiz_id', 'question_ids', 'current_index', 'user_answers']);

// app/Http/Controllers/PlayController.php - result メソッド内の修正

        // ... (省略) ...

        // セッションをクリア
        Session::forget(['quiz_id', 'question_ids', 'current_index', 'user_answers']);

        // ★★★ スコア保存処理 ★★★
        \App\Models\Score::create([
            'user_id' => auth()->id(), // 現在認証されているユーザーID
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_questions' => $total,
        ]);
        // ★★★ 修正箇所終了 ★★★

        return view('play.result', compact('quiz', 'score', 'total', 'results'));
    }
}