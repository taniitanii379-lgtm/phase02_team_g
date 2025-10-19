<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    // 自分のスコア履歴を表示
    public function index()
    {
        $scores = Score::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('scores.index', compact('scores'));
    }
  
    public function quiz()
{
    return $this->belongsTo(Quiz::class);
}

}
