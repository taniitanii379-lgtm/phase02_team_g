<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">クイズ一覧</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- フラッシュメッセージ --}}
                @if(session('success'))
                    <p class="text-green-600 mb-4">{{ session('success') }}</p>
                @endif

                {{-- 新規作成リンク --}}
                <div class="mb-4">
                    <a href="{{ route('quizzes-management.create') }}" class="text-blue-600 hover:underline">+ 新しいクイズを作成</a>
                </div>

                <table class="w-full border border-gray-300 table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">クイズ名（タイトル）</th>
                            <th class="border px-4 py-2">カテゴリ</th>
                            <th class="border px-4 py-2">問題文</th>
                            <th class="border px-4 py-2">選択肢</th>
                            <th class="border px-4 py-2">正解</th>
                            <th class="border px-4 py-2">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($quizzes as $quiz)
                            <tr>
                                {{-- クイズ名 --}}
                                <td class="border px-4 py-2">{{ $quiz->title }}</td>

                                {{-- カテゴリ --}}
                                <td class="border px-4 py-2">
                                    {{ $quiz->category->name ?? '未分類' }}
                                </td>

                                {{-- 問題文 --}}
                                <td class="border px-4 py-2">{{ $quiz->question }}</td>

                                {{-- 選択肢 --}}
                                <td class="border px-4 py-2">
                                    <ul class="list-disc pl-5">
                                        @if (is_array($quiz->choices))
                                            @foreach ($quiz->choices as $index => $choice)
                                                <li @if($index == $quiz->answer) class="font-bold" @endif>
                                                    {{ $choice }}
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="text-red-500">選択肢が未設定です</li>
                                        @endif
                                    </ul>
                                </td>

                                {{-- 正解 --}}
                                <td class="border px-4 py-2">
                                    {{ $quiz->choices[$quiz->answer] ?? '不明' }}
                                </td>

                                {{-- 操作 --}}
                                <td class="border px-4 py-2">
                                    <a href="{{ route('quizzes-management.edit', $quiz->id) }}" class="text-blue-500 hover:underline">
                                        編集
                                    </a>
                                    |
                                    <form action="{{ route('quizzes-management.destroy', $quiz->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('本当に削除しますか？')" class="text-red-500 hover:underline">
                                            削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">
                                    クイズがまだ登録されていません。
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>