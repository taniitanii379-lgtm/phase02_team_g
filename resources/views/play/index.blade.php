<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->title }} - プレイ</title>
    <!-- Tailwind CSSをCDNで読み込み (アプリ全体で共有) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-12">

    <!-- UIをリザルト画面と同じ白いカード形式に修正 -->
    <div class="w-full max-w-lg mx-auto bg-white rounded-2xl shadow-2xl p-8">
        
        <div class="text-center">
            
            <!-- クイズタイトル -->
            <h1 class="text-2xl font-bold mb-4 text-gray-800">{{ $quiz->title }}</h1>
            
            <!-- 進行状況 -->
            <div class="text-xl mb-8 p-3 rounded-lg border-b-2 border-gray-300">
                <span class="font-extrabold text-indigo-600">
                    第 {{ Session::get('current_index', 0) + 1 }} 問 
                </span> 
                / 全 {{ $totalQuestions }} 問
            </div>

            <!-- 1問表示フォーム -->
            <form method="POST" action="{{ route('play.answer', $quiz) }}">
                @csrf

                <!-- 問題文 (リザルト画面のスコアボックスに近いデザイン) -->
                <div class="mb-10 p-8 border-4 border-green-200 rounded-xl bg-green-50 shadow-inner">
                    <h2 class="text-3xl font-bold text-gray-800 leading-relaxed">
                        {{ $currentQuestion->question }}
                    </h2>
                </div>
                
                <!-- 〇 or × の回答ボタン (リザルト画面に合わせた統一感のあるデザイン) -->
                <div class="flex space-x-6 mt-12 justify-center">
                    <!-- 〇 ボタン -->
                    <button type="submit" name="answer" value="1" 
                            class="flex-1 bg-green-500 text-white px-8 py-4 text-3xl font-extrabold rounded-full shadow-lg 
                                    hover:bg-green-600 transition transform hover:scale-[1.05]">
                        〇
                    </button>
                    
                    <!-- × ボタン -->
                    <button type="submit" name="answer" value="0" 
                            class="flex-1 bg-red-500 text-white px-8 py-4 text-3xl font-extrabold rounded-full shadow-lg 
                                    hover:bg-red-600 transition transform hover:scale-[1.05]">
                        ×
                    </button>
                </div>
            </form>

            <div class="mt-8">
                <a href="{{ route('quizzes.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 underline">
                    中断して一覧に戻る
                </a>
            </div>
        </div>
    </div>
</body>
</html>