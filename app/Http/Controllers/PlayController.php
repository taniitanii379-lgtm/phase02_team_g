<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BadgeService;

class PlayController extends Controller
{
    // クイズプレイ画面
    public function index($quizId)
{
    return view('quizzes.play', [   // ここを 'play.index' → 'quizzes.play' に変更
        'quizId' => $quizId,
    ]);
}

    // クイズ回答送信
    public function submit(Request $request, $quizId, BadgeService $badgeService)
    {
        $user = Auth::user();
        // TODO: 回答の処理とスコア計算
        // $answers = $request->input('answers');

        $badgeService->awardBadges($user);

        return redirect()->route('home')->with('status', 'クイズを送信しました');
    }
}
