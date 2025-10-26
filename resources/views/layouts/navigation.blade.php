<nav x-data="{ open: false }" class="bg-[#BFDBFE] border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- ロゴ -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-blue-900" />
                </a>
            </div>

            <!-- デスクトップメニュー（PC画面で表示） -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <a href="{{ route('home') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
                   ホーム
                </a>
                <a href="{{ route('quizzes.index') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
                   クイズをプレイ
                </a>
                <a href="{{ route('scores.index') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
                   スコア
                </a>
                <a href="{{ route('quizzes-management.index') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
                   クイズ作成
                </a>
                <a href="{{ route('profile.show') }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
                   プロフィール
                </a>
            </div>

            <!-- ハンバーガーボタン（スマホだけ表示） -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] focus:outline-none focus:bg-[#D6E4FF] focus:text-blue-700 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- モバイルメニュー（スマホだけ表示） -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden bg-[#BFDBFE]">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" 
               class="block px-4 py-2 text-base font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
               ホーム
            </a>
            <a href="{{ route('quizzes.index') }}" 
               class="block px-4 py-2 text-base font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
               クイズをプレイ
            </a>
            <a href="{{ route('scores.index') }}" 
               class="block px-4 py-2 text-base font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
               スコア
            </a>
            <a href="{{ route('quizzes-management.index') }}" 
               class="block px-4 py-2 text-base font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
               クイズ作成
            </a>
            <a href="{{ route('profile.show') }}" 
               class="block px-4 py-2 text-base font-medium text-blue-900 hover:text-blue-700 hover:bg-[#D6E4FF] transition">
               プロフィール
            </a>
        </div>
    </div>
</nav>
