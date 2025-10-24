<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- ロゴ -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- デスクトップメニュー（PC画面で表示） -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <a href="{{ route('home') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
                   ホーム
                </a>
                <a href="{{ route('quizzes.index') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
                   クイズをプレイ
                </a>
                <a href="{{ route('scores.index') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
                   スコア
                </a>
                <a href="{{ route('quizzes-management.index') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
                   クイズ作成
                </a>
                <a href="{{ route('profile.show') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
                   プロフィール
                </a>
            </div>

            <!-- ハンバーガーボタン（スマホだけ表示） -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- モバイルメニュー（スマホだけ表示） -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" 
               class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
               ホーム
            </a>
            <a href="{{ route('quizzes.index') }}" 
               class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
               クイズをプレイ
            </a>
            <a href="{{ route('scores.index') }}" 
               class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
               スコア
            </a>
            <a href="{{ route('quizzes-management.index') }}" 
               class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
               クイズ作成
            </a>
            <a href="{{ route('profile.show') }}" 
               class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition">
               プロフィール
            </a>
        </div>
    </div>
</nav>