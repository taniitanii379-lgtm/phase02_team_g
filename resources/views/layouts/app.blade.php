<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen relative overflow-hidden">
        <!-- Grid Background -->
        <div class="absolute inset-0" style="
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 40px 40px;
            background-color: #2563EB; /* 背景色 */
        "></div>

        <!-- ナビゲーション -->
        <div class="fixed top-0 left-0 right-0 z-50">
            @include('layouts.navigation')
        </div>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-[#BFDBFE] shadow mt-16 relative z-10">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="pt-16 relative z-10">
            {{ $slot }}
        </main>
    </div>

    {{-- ▼▼▼ レベルアップ演出用のモーダル ▼▼▼ --}}
    <div id="level-up-modal" class="notification-modal">
        <div class="modal-content zoom-in">
            <div class="modal-icon">🎉</div>
            <div class="modal-title">LEVEL UP!</div>
            <div class="modal-body">レベル <span id="new-level"></span> に上がりました！</div>
        </div>
    </div>

    {{-- ▼▼▼ 新規バッジ獲得の通知（トースト） ▼▼▼ --}}
    <div id="new-badge-toast" class="toast-notification slide-in">
        <div id="toast-badge-icon"></div>
        <div>
            <div class="toast-title">新しいバッジを獲得！</div>
            <div id="toast-badge-name"></div>
        </div>
    </div>

    {{-- ▼▼▼ アニメーション用のCSS ▼▼▼ --}}
    <style>
        .notification-modal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.7); display: none; justify-content: center; align-items: center; z-index: 2000;
        }
        .notification-modal.show { display: flex; }
        .notification-modal .modal-content {
            background: white; color: #333; padding: 2rem 3rem; border-radius: 12px; text-align: center;
        }
        .notification-modal .modal-icon { font-size: 4rem; }
        .notification-modal .modal-title { font-size: 2rem; font-weight: bold; margin: 0.5rem 0; }
        .notification-modal .modal-body { font-size: 1.2rem; }

        .toast-notification {
            position: fixed; top: 20px; right: 20px;
            background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 8px;
            display: none; align-items: center; padding: 1rem; z-index: 2000;
            border-left: 5px solid #48BB78;
        }
        .toast-notification.show { display: flex; }
        .toast-notification .toast-title { font-weight: bold; }
        #toast-badge-icon { font-size: 2rem; margin-right: 1rem; }

        .zoom-in { animation: zoomIn 0.4s ease-out; }
        @keyframes zoomIn { from { transform: scale(0.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .slide-in { animation: slideIn 0.5s ease-out forwards; }
        @keyframes slideIn { from { transform: translateX(120%); } to { transform: translateX(0); } }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // レベルアップモーダル
        @if (session('level_up'))
            const levelUpModal = document.getElementById('level-up-modal');
            const newLevelSpan = document.getElementById('new-level');
            newLevelSpan.innerText = "{{ session('level_up') }}";
            levelUpModal.classList.add('show');
            setTimeout(() => levelUpModal.classList.remove('show'), 3000);
        @endif

        // 新規バッジトースト
        @if (session('new_badge'))
            const newBadgeToast = document.getElementById('new-badge-toast');
            const toastIcon = document.getElementById('toast-badge-icon');
            const toastName = document.getElementById('toast-badge-name');
            const badge = @json(session('new_badge'));
            toastIcon.innerText = badge.icon;
            toastName.innerText = badge.name;
            newBadgeToast.classList.add('show');
            setTimeout(() => newBadgeToast.classList.remove('show'), 4000);
        @endif
    });
    </script>
</body>
</html>
