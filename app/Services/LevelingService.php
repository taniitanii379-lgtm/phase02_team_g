<?php

namespace App\Services;

use App\Models\User;

class LevelingService
{
    /**
     * ユーザーに経験値を加算し、レベルアップをチェックする
     * @param User $user
     * @param int $xpAmount 加算する経験値
     */
    public function addXp(User $user, int $xpAmount): void
    {
        $profile = $user->profile;
        $profile->experience_points += $xpAmount;

        $this->checkForLevelUp($user); // レベルアップチェック

        $profile->save();
    }

    /**
     * レベルアップの条件を満たしているかチェックする
     * @param User $user
     */
    private function checkForLevelUp(User $user): void
    {
        $profile = $user->profile;
        $xpMap = config('leveling.xp_map');
        $nextLevel = $profile->level + 1;

        // 次のレベルの定義が存在し、かつ現在の経験値が必要経験値を超えているかチェック
        // whileループにすることで、一度に複数レベルアップするケースにも対応
        while (isset($xpMap[$nextLevel]) && $profile->experience_points >= $xpMap[$nextLevel]) {
            $profile->level = $nextLevel;

            session()->flash('level_up', $nextLevel);
            
            $nextLevel++;
        }
    }
}