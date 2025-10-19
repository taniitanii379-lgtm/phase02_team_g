<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;

class BadgeService
{
    public function awardBadges(User $user)
    {
        // ユーザー情報を再取得して最新の状態でチェック
        $user->load('profile', 'badges');

        $this->checkPlaysForBeginnerBadge($user);
        $this->checkPlaysForVeteranBadge($user);
        $this->checkScoreForHighScorerBadge($user);
        // ... 他のバッジチェック処理を追加 ...
    }

    private function awardBadge(User $user, string $badgeName)
    {
        // ユーザーがまだそのバッジを持っていなければ
        if (!$user->badges->pluck('name')->contains($badgeName)) {
            $badge = Badge::where('name', $badgeName)->first();
            if ($badge) {
                $user->badges()->attach($badge->id);
            }
        }
    }

    private function checkPlaysForBeginnerBadge(User $user)
    {
        if ($user->profile->total_plays >= 10) {
            $this->awardBadge($user, 'ビギナー');
        }
    }
    
    private function checkPlaysForVeteranBadge(User $user)
    {
        if ($user->profile->total_plays >= 100) {
            $this->awardBadge($user, '百戦錬磨');
        }
    }
    
    private function checkScoreForHighScorerBadge(User $user)
    {
        if ($user->profile->total_score >= 100000) {
            $this->awardBadge($user, '高得点者');
        }
    }
}