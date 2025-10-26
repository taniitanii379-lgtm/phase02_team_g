<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">クイズ詳細</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            {{-- クイズ基本情報 --}}
            <div class="mb-6 border-b pb-4">
                <p><strong>ID:</strong> {{ $quiz->id }}</p>
                <p><strong>タイトル:</strong> {{ $quiz->title }}</p>
                <p><strong>カテゴリ:</strong> {{ $quiz->category->name ?? '未分類' }}</p>
            </div>

            {{-- クイズの問題一覧 --}}
            <div class="space-y-6">
                @foreach($quiz->questions as $index => $question)
                    <div class="p-4 border rounded shadow-sm bg-gray-50">
                        <p class="font-semibold mb-2">問題 {{ $index + 1 }}:</p>
                        <p class="mb-2">{{ $question->question }}</p>

                        <p class="font-semibold">選択肢:</p>
                        <ul class="list-decimal list-inside ml-4 mb-2">
                            @foreach ($question->choices as $i => $choice)
                            @if(trim($choice) !== '') {{-- 空文字を無視 --}}
                                <li @if($i == $question->answer) class="font-bold text-green-600" @endif>
                                    {{ $choice }}
                                </li>
                                @endif
                            @endforeach
                        </ul>

                        <p><strong>正解:</strong> {{ $question->choices[$question->answer] ?? '不明' }}</p>
                    </div>
                @endforeach
            </div>

            {{-- 操作ボタン --}}
            <div class="mt-6 flex flex-wrap gap-4">
                <a href="{{ route('quizzes-management.edit', $quiz->id) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                   編集
                </a>

                <form action="{{ route('quizzes-management.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">削除</button>
                </form>

                <a href="{{ route('quizzes-management.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                   一覧に戻る
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
