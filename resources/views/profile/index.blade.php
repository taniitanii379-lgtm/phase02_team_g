<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>ユーザー名: {{ $user->name }}</p>
                <p>メール: {{ $user->email }}</p>
                <!-- 他に表示したい情報を追加 -->
            </div>
        </div>
    </div>
</x-app-layout>
