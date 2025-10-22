<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">クイズ編集</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('quizzes-management.update', $quiz->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- タイトル -->
                <div class="mb-4">
                    <label for="title" class="block font-medium text-sm text-gray-700">クイズ名（タイトル）</label>
                    <input type="text" name="title" id="title"
                           class="border-gray-300 rounded-md shadow-sm mt-1 block w-full"
                           value="{{ old('title', $quiz->title) }}"
                           placeholder="例：ことわざクイズ 第1問"
                           required>
                </div>

                <!-- 問題文 -->
                <div class="mb-4">
                    <label for="question" class="block font-medium text-sm text-gray-700">問題文</label>
                    <input type="text" name="question" id="question"
                           class="border-gray-300 rounded-md shadow-sm mt-1 block w-full"
                           value="{{ old('question', $quiz->question) }}"
                           required>
                </div>

                <!-- 選択肢 -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">選択肢（2つ以上）</label>
                    @for ($i = 0; $i < 4; $i++)
                        <input type="text" name="choices[]"
                               class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-1"
                               placeholder="選択肢{{ $i + 1 }}"
                               value="{{ old('choices.'.$i, $quiz->choices[$i] ?? '') }}">
                    @endfor
                </div>

                <!-- 正解 -->
                <div class="mb-4">
                    <label for="answer" class="block font-medium text-sm text-gray-700">正解の選択肢番号 (0から開始)</label>
                    <input type="number" name="answer" id="answer"
                           class="border-gray-300 rounded-md shadow-sm mt-1 block w-full"
                           value="{{ old('answer', $quiz->answer) }}"
                           min="0" required>
                </div>

                <!-- カテゴリ -->
                <div class="mb-4">
                    <label for="category_id" class="block font-medium text-sm text-gray-700">カテゴリ</label>
                    <select name="category_id" id="category_id" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full">
                        <option value="">未分類</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" {{ old('category_id', $quiz->category_id) == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">更新する</button>
            </form>

        </div>
    </div>
</x-app-layout>
