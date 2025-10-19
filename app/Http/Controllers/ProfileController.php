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
     * プロフィール画面を表示する
     * URL: /profile
     */
    public function show(): View
    {
        $user = Auth::user()->load('profile', 'badges');

        return view('profile.show', compact('user'));
    }

    /**
     * プロフィール編集フォームを表示する
     * URL: /profile/edit
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * プロフィール情報の更新
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
     * ユーザーアカウントを削除する
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