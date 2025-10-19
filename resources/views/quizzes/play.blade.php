<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h1 class="text-4xl font-extrabold mb-8 text-gray-800 text-center">
                    クイズを選択
                </h1>

                <!-- 縦幅を広げるために max-w-xl を削除し、コンテンツの幅を max-w-lg に調整 -->
                <div class="w-full max-w-lg mx-auto space-y-6">
                    
                    @foreach ($quizzes as $quiz)
                        <a href="{{ route('play.show', $quiz) }}"
                           class="block bg-gray-50 shadow-lg rounded-2xl text-center py-6 text-2xl font-semibold
                                  text-gray-700
                                  hover:bg-blue-600 hover:text-white transition duration-200 transform hover:scale-[1.02]">
                            {{ $quiz->title }}
                        </a>
                    @endforeach

                    @if ($quizzes->isEmpty())
                        <p class="text-gray-500 text-center mt-10">まだクイズが登録されていません。</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>