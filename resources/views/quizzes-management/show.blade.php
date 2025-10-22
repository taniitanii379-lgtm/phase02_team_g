<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">クイズ詳細</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="mb-4">
                <p><strong>ID:</strong> {{ $quiz->id }}</p>
                <p><strong>タイトル:</strong> {{ $quiz->title }}</p>
                <p><strong>問題文:</strong> {{ $quiz->question }}</p>
                <p><strong>選択肢:</strong></p>
                <ul class="list-disc list-inside ml-4">
                    @foreach ($quiz->choices as $index => $choice)
                        <li class=($index == $quiz->answer) class="font-bold text-green-600" @endif>
                            {{ $choice }}
                        </li>
                    @endforeach
                </ul>
