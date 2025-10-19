<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            プロフィール情報
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            アカウントのプロフィール情報やメールアドレスを更新します。
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar_upload" :value="__('アイコン')" />
            <div class="mt-2 flex items-center gap-4">
                @if ($user->avatar)
                    <img src="{{ Str::startsWith($user->avatar, ['http', 'avatars/']) ? asset($user->avatar) : asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="rounded-full h-20 w-20 object-cover">
                @else
                    <div class="rounded-full h-20 w-20 bg-gray-200 flex items-center justify-center text-gray-500">
                        <span>No Image</span>
                    </div>
                @endif
                <div class="flex-grow">
                    <x-text-input id="avatar_upload" name="avatar_upload" type="file" class="block w-full" accept="image/png, image/jpeg" />
                    <x-input-error class="mt-2" :messages="$errors->get('avatar_upload')" />
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-200">
        <div>
            <div>
                <x-input-label for="name" :value="__('ユーザー名')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                @endif
            </div>

            <div class="mt-6">
                <x-input-label for="theme_color" value="テーマカラー" />
                <input id="theme_color" name="theme_color" type="color" class="mt-1 block" value="{{ old('theme_color', $user->profile->theme_color) }}">
                <x-input-error class="mt-2" :messages="$errors->get('theme_color')" />
            </div>
        </div>

        <hr class="my-6 border-gray-200">
        <div>
            <x-input-label for="bio" value="一言コメント (100文字以内)" />
            <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div>
            <x-input-label for="bio_template" value="定型文から選ぶ" />
            <select id="bio_template" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">-- 選択してください --</option>
                <option value="クイズ初心者です🔰 よろしくお願いします！">初心者です</option>
                <option value="得意ジャンルを極めたいです！🔥">得意ジャンル極めたい</option>
                <option value="全国ランキング上位を目指してます！🏆">ランキング上位目指す</option>
            </select>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    if (document.getElementById('bio') && document.getElementById('bio_template')) {
        const bioTextarea = document.getElementById('bio');
        const bioTemplateSelect = document.getElementById('bio_template');

        bioTemplateSelect.addEventListener('change', function() {
            if (this.value) {
                bioTextarea.value = this.value;
            }
        });
    }
</script>

<script>
    // このスクリプトが他の場所で実行される可能性も考慮し、要素が存在するかチェック
    if (document.getElementById('bio') && document.getElementById('bio_template')) {
        const bioTextarea = document.getElementById('bio');
        const bioTemplateSelect = document.getElementById('bio_template');

        bioTemplateSelect.addEventListener('change', function() {
            if (this.value) {
                bioTextarea.value = this.value;
            }
        });
    }
</script>

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