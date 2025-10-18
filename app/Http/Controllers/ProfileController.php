<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * 【新しい機能】リッチなプロフィール画面を表示する
     * URL: /profile
     */
    public function show(): View
    {
        $user = Auth::user();

        // --- プロフィール情報（ダミー）---
        $profile = [
            'bio' => $user->bio ?? '自己紹介がまだ設定されていません',
            'level' => 18,
            'level_progress' => 75,
            'theme_color' => '#4A90E2',
            'icon_url' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=200&d=identicon',
        ];

        // --- クイズ成績（ダミー）---
        $stats = [
            'total_plays' => 256,
            'accuracy' => 88,
            'total_score' => 125480,
            'favorite_genre' => '歴史',
            'weakest_genre' => '科学',
        ];

        // --- 達成した称号・バッジ（ダミー）---
        $badges = [
            ['name' => '初級クイズマスター', 'icon' => '🎓', 'description' => '初めてクイズに正解した'],
            ['name' => '歴史探求者', 'icon' => '📜', 'description' => '歴史クイズを50回プレイした'],
            ['name' => 'スピードスター', 'icon' => '⚡️', 'description' => '平均回答時間5秒以内を達成'],
            ['name' => '百戦錬磨', 'icon' => '🛡️', 'description' => '100回クイズをプレイした'],
        ];

        // 全てのデータをビューに渡す
        return view('profile.show', compact('user', 'profile', 'stats', 'badges'));
    }

    /**
     * 【既存の機能】プロフィール編集フォームを表示する
     * URL: /profile/edit
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * 【既存の機能】プロフィール情報を更新する
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        
        // 新しい画像ファイルがアップロードされた場合
        if ($request->hasFile('avatar_upload')) {
            // 'avatars' フォルダに画像を保存し、そのパスを$pathに格納
            $path = $request->file('avatar_upload')->store('avatars', 'public');
            // ユーザーのavatarカラムに新しいパスを保存
            $user->avatar = $path;
        } 
        
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
        
    }

    /**
     * 【ユーザーアカウントを削除する
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}