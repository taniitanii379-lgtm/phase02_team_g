<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;

class BadgeService
{
    /**
     * ユーザーの成績をチェックして、新しいバッジを授与する
     *
     * @param User $user
     */
    public function awardBadges(User $user)
    {
        // ユーザーの総プレイ回数を取得（これはダミーです。実際にはデータベースから取得してください）
        $totalPlays = 10; // $user->scores()->count(); のような形になる

        // --- 「ビギナー」バッジの獲得条件をチェック ---
        // 条件：総プレイ回数が10回以上
        if ($totalPlays >= 10) {
            $this->awardBadgeToUser($user, 'ビギナー');
        }

        // --- 「歴史探求者」バッジの獲得条件をチェック ---
        // 条件：歴史クイズのプレイ回数が5回以上
        // ...
    }

    /**
     * 特定のバッジをユーザーに授与する（まだ持っていなければ）
     *
     * @param User $user
     * @param string $badgeName
     */
    private function awardBadgeToUser(User $user, string $badgeName)
    {
        // バッジ名からバッジのIDを取得
        $badge = Badge::where('name', $badgeName)->first();

        // バッジが存在し、かつユーザーがまだそのバッジを持っていなければ授与する
        if ($badge && !$user->badges()->where('badge_id', $badge->id)->exists()) {
            $user->badges()->attach($badge->id);
        }
    }
}