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

        $this->checkPlaysForNewbieBadge($user);
        $this->checkPlaysForBeginnerBadge($user);    
        $this->checkPlaysForVeteranBadge($user);
        $this->checkAccuracyForGeniusBadge($user);
        $this->checkScoreForHighScorerBadge($user);
   
    }

    private function awardBadge(User $user, string $badgeName)
    {
        if (!$user->badges->pluck('name')->contains($badgeName)) {
            $badge = Badge::where('name', $badgeName)->first();
            if ($badge) {
                $user->badges()->attach($badge->id);
            }
        }
    }

    private function checkPlaysForNewbieBadge(User $user)
    {
        if ($user->profile->total_plays >= 1) {
            $this->awardBadge($user, 'はじめの一歩');
        }
    }

    private function checkPlaysForBeginnerBadge(User $user)
    {
        if ($user->profile->total_plays >= 10) {
            $this->awardBadge($user, 'クイズデビュー');
        }
    }
    
    private function checkPlaysForVeteranBadge(User $user)
    {
        if ($user->profile->total_plays >= 100) {
            $this->awardBadge($user, '百戦錬磨');
        }
    }

    private function checkAccuracyForGeniusBadge(User $user)
    {
        if ($user->profile->accuracy >= 80) {
            $this->awardBadge($user, '安定の天才');
        }
    }
    
    private function checkScoreForHighScorerBadge(User $user)
    {
        if ($user->profile->total_score >= 100000) {
            $this->awardBadge($user, '高得点者');
        }
    }
}