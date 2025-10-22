<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex space-x-4">
                <!-- ホーム -->
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium">ホーム</a>

                <!-- クイズ一覧 / プレイ開始 -->
                <!-- 修正: quizzes.create と play.index の特定ID参照を削除し、一覧画面に統一 -->
                <a href="{{ route('quizzes.index') }}" class="px-3 py-2 rounded-md text-sm font-medium">クイズをプレイ</a>

                <!-- スコア -->
                <a href="{{ route('scores.index') }}" class="px-3 py-2 rounded-md text-sm font-medium">スコア</a>
                
                <!-- クイズ作成 -->
                <a href="{{ route('quizzes-management.index') }}" class="px-3 py-2 rounded-md text-sm font-medium">クイズ作成</a>

                <!-- プロフィール -->
                <a href="{{ route('profile.index') }}" class="px-3 py-2 rounded-md text-sm font-medium">プロフィール</a>
            </div>

            <!-- ロゴなど -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>
        </div>
    </div>
</nav>