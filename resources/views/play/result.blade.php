<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->title }} - 結果</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10">
    <div class="w-full max-w-xl mx-auto p-8 bg-white rounded-2xl shadow-2xl text-center">
        
        <h1 class="text-3xl font-bold mb-2 text-gray-800">{{ $quiz->title }}</h1>
        <p class="text-xl text-green-600 mb-6 font-semibold">クイズ完了！</p>
        
        <!-- スコア表示 -->
        <div class="p-6 bg-green-50 rounded-xl mb-8 border-4 border-green-200">
            <p class="text-5xl font-extrabold text-green-700 mb-2">
                {{ $score }} / {{ $total }}
            </p>
            <p class="text-lg text-gray-600">点</p>
        </div>

        <div class="text-center">
            <a href="{{ route('quizzes.index') }}" 
               class="inline-block bg-blue-600 text-white px-6 py-3 text-lg font-semibold rounded-full shadow-lg 
                      hover:bg-blue-700 transition transform hover:scale-105">
                クイズ一覧に戻る
            </a>
        </div>

        <details class="text-left mt-8 p-3 border rounded-lg bg-gray-50">
            <summary class="font-semibold cursor-pointer text-gray-700">
                全問の回答結果を見る
            </summary>
            <ul class="mt-3 space-y-3">
                @foreach ($results as $item)
                    <li class="p-3 rounded-lg border {{ $item['is_correct'] ? 'bg-green-50 border-green-300' : 'bg-red-50 border-red-300' }}">
                        <p class="text-sm font-medium text-gray-800">{{ $item['question'] }}</p>
                        <p class="text-xs mt-1">
                            正解: <span class="font-bold">{{ $item['correct'] ? '〇' : '×' }}</span> / 
                            あなたの回答: <span class="font-bold">{{ $item['user'] === 1 ? '〇' : ($item['user'] === 0 ? '×' : '未回答') }}</span>
                        </p>
                    </li>
                @endforeach
            </ul>
        </details>
        
    </div>
</body>
</html>