<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スコア履歴
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($scores->isEmpty())
                    <p class="text-gray-600">まだスコア履歴がありません。</p>
                @else
                    <table class="min-w-full border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-2 border-b">日付</th>
                                <th class="p-2 border-b">スコア</th>
                                <th class="p-2 border-b">クイズ名</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scores as $score)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-2 border-b">{{ $score->created_at->format('Y/m/d H:i') }}</td>
                                    <td class="p-2 border-b">{{ $score->value ?? 'N/A' }}</td>
                                    {{-- Quizモデルがなくても安全に表示 --}}
                                    <td class="p-2 border-b">{{ optional($score->quiz)->title ?? '（不明）' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
