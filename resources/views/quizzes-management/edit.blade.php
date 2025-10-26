<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">クイズ編集</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            {{-- エラーメッセージ --}}
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="quiz-form" action="{{ route('quizzes-management.update', $quiz->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- タイトル --}}
                <div class="mb-4">
                    <label for="title" class="block font-medium text-sm text-gray-700">クイズ名（タイトル）</label>
                    <input type="text" name="title" id="title"
                           class="border-gray-300 rounded-md shadow-sm mt-1 block w-full"
                           value="{{ old('title', $quiz->title) }}" placeholder="例：ことわざクイズ" required>
                </div>

                {{-- カテゴリ --}}
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

                {{-- 問題一覧 --}}
                <div id="questions-wrapper">
                    @php
                        $oldQuestions = old('questions', $quiz->questions->map(function($q) {
                            return [
                                'question' => $q->question,
                                'choices' => $q->choices,
                                'answer' => $q->answer
                            ];
                        })->toArray());
                    @endphp

                    @foreach ($oldQuestions as $index => $q)
                        <div class="question-block mb-6 border p-4 rounded">
                            <h3 class="font-semibold mb-2">問題 {{ $index + 1 }}</h3>

                            <label class="block font-medium text-sm text-gray-700">問題文</label>
                            <input type="text" name="questions[{{ $index }}][question]"
                                   class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-2"
                                   value="{{ $q['question'] }}" required>

                            <label class="block font-medium text-sm text-gray-700">選択肢（2つ以上）</label>
                            @for ($i = 0; $i < 4; $i++)
                                <input type="text" name="questions[{{ $index }}][choices][]"
                                       class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-1 choice-input"
                                       value="{{ $q['choices'][$i] ?? '' }}" placeholder="選択肢{{ $i + 1 }}" {{ $i < 2 ? 'required' : '' }}>
                            @endfor

                            <label class="block font-medium text-sm text-gray-700">正解の選択肢番号 (0から開始)</label>
                            <input type="number" name="questions[{{ $index }}][answer]"
                                   class="border-gray-300 rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ $q['answer'] ?? 0 }}" min="0" required>

                            <button type="button" class="mt-2 text-sm text-red-600 remove-question">この問題を削除</button>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="add-question" class="block mb-4 px-4 py-2 bg-blue-500 text-white rounded">＋問題を追加</button>

                <div class="mt-4">
                    <button type="submit" class="block px-6 py-2 rounded text-white font-semibold bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none transition duration-200">
                        更新する
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let questionIndex = {{ count($oldQuestions) }};

        // 問題追加
        document.getElementById('add-question').addEventListener('click', function () {
            const wrapper = document.getElementById('questions-wrapper');
            const newBlock = document.createElement('div');
            newBlock.classList.add('question-block','mb-6','border','p-4','rounded');
            newBlock.innerHTML = `
                <h3 class="font-semibold mb-2">問題 ${questionIndex + 1}</h3>
                <label class="block font-medium text-sm text-gray-700">問題文</label>
                <input type="text" name="questions[${questionIndex}][question]" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-2" required>

                <label class="block font-medium text-sm text-gray-700">選択肢（2つ以上）</label>
                <input type="text" name="questions[${questionIndex}][choices][]" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-1 choice-input" placeholder="選択肢1" required>
                <input type="text" name="questions[${questionIndex}][choices][]" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-1 choice-input" placeholder="選択肢2" required>
                <input type="text" name="questions[${questionIndex}][choices][]" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-1 choice-input" placeholder="選択肢3">
                <input type="text" name="questions[${questionIndex}][choices][]" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full mb-1 choice-input" placeholder="選択肢4">

                <label class="block font-medium text-sm text-gray-700">正解の選択肢番号 (0から開始)</label>
                <input type="number" name="questions[${questionIndex}][answer]" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="0" min="0" required>

                <button type="button" class="mt-2 text-sm text-red-600 remove-question">この問題を削除</button>
            `;
            wrapper.appendChild(newBlock);
            questionIndex++;
        });

        // 問題削除
        document.getElementById('questions-wrapper').addEventListener('click', function(e){
            if(e.target.classList.contains('remove-question')){
                e.target.closest('.question-block').remove();
            }
        });

        // 送信前チェック: 各問題の選択肢は最低2つ必須
        document.getElementById('quiz-form').addEventListener('submit', function(e){
            const blocks = document.querySelectorAll('.question-block');
            for(const block of blocks){
                const choices = Array.from(block.querySelectorAll('.choice-input'));
                const filled = choices.filter(c => c.value.trim() !== '');
                if(filled.length < 2){
                    alert('各問題の選択肢は最低2つ必要です。');
                    e.preventDefault();
                    return false;
                }
            }
        });
    </script>
</x-app-layout>
