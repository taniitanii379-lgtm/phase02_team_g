<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">クイズ一覧</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- クイズがある場合 --}}
                @if($quizzes->count())
                    <ul class="space-y-4">
                        @foreach($quizzes as $quiz)
                            <li class="p-4 border rounded hover:shadow-md transition">
                                <h3 class="text-lg font-semibold">{{ $quiz->title }}</h3>
                                <p class="text-gray-600 mb-2">{{ $quiz->description ?? '説明なし' }}</p>

                                {{-- プレイページへのリンク --}}
                                <a href="{{ route('play.show', ['quiz' => $quiz->id]) }}"
                                   class="text-blue-600 hover:underline mr-4">
                                    プレイする
                                </a>

                                {{-- 結果ページへのリンク（もしスコアがある場合） --}}
                                <a href="{{ route('play.result', ['quiz' => $quiz->id]) }}"
                                   class="text-green-600 hover:underline mr-4">
                                    結果を見る
                                </a>

                                {{-- 回答送信リンク（デバッグ用や管理者用） --}}
                                <a href="{{ route('play.answer', ['quiz' => $quiz->id]) }}"
                                   class="text-red-600 hover:underline">
                                    回答送信
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>クイズはまだ登録されていません。</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
