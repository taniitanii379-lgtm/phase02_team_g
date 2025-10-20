<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\Badge;

class ProfileController extends Controller
{
    /**
     * プロフィール画面を表示する
     * URL: /profile
     */
    public function show(): View
    {
        $user = Auth::user()->load('profile', 'badges');
        $allBadges = Badge::all();
        $userBadgeIds = $user->badges->pluck('id');

        return view('profile.show', compact('user', 'allBadges', 'userBadgeIds'));
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
        
        if ($request->hasFile('avatar_upload')) {
            $path = $request->file('avatar_upload')->store('avatars', 'public');
            $user->avatar = $path;
        } 

        if ($request->filled('theme_color')) {
            $user->profile->update([
                'theme_color' => $request->input('theme_color'),
            ]);
        }
        
        $user->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
        
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