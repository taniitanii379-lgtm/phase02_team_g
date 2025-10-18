<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information, email address, and avatar.") }}
        </p>
    </header>

    {{-- メールアドレス確認メール送信用 --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- メインの更新フォーム --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- ▼▼▼ アイコン画像 変更機能 ▼▼▼ --}}
        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />
            
            {{-- 現在のアイコン --}}
            <div class="mt-2">
                @if ($user->avatar)
                    <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="rounded-full h-20 w-20 object-cover">
                @else
                    {{-- デフォルトアイコンの表示 --}}
                    <div class="rounded-full h-20 w-20 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
            </div>

            {{-- 1. 画像をアップロード --}}
            <div class="mt-4">
                <x-input-label for="avatar_upload" :value="__('Upload a new image')" />
                <x-text-input id="avatar_upload" name="avatar_upload" type="file" class="mt-1 block w-full" accept="image/png, image/jpeg" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar_upload')" />
            </div>

            {{-- 2. フリーアイコンから選択 --}}
            <div class="mt-4">
                 <p class="text-sm text-gray-600">{{ __('Or, select from our free icons:') }}</p>
                 <div class="flex flex-wrap gap-4 mt-2 icon-list">
                    @foreach (['avatars/icon1.png', 'avatars/icon2.png', 'avatars/icon3.png', 'avatars/icon4.png'] as $iconPath)
                        <label class="icon-option">
                            <input type="radio" name="avatar_select" value="{{ $iconPath }}" {{ $user->avatar == $iconPath ? 'checked' : '' }}>
                            <img src="{{ asset($iconPath) }}" alt="Free Icon">
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- ▲▲▲ アイコン画像 変更機能 ここまで ▲▲▲ --}}

        {{-- ユーザー名 --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- メールアドレス --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

{{-- アイコン選択用のCSS --}}
<style>
    .icon-list {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .icon-option input[type="radio"] {
        display: none;
    }
    .icon-option img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid transparent;
        transition: border-color 0.2s ease-in-out;
    }
    .icon-option input[type="radio"]:checked + img {
        border-color: #4f46e5; /* Tailwindの indigo-600 のような色 */
    }
</style>