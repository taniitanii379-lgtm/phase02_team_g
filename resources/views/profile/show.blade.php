<x-app-layout>
    
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <style>
                :root {
                    --theme-color: {{ $user->profile->theme_color ?? '#2fcb85ff' }};
                    --card-bg: #ffffff;
                    --text-color: #333;
                    --sub-text-color: #777;
                    --border-color: #eee;
                }

                /* カード全体のスタイル */
                .profile-card {
                    width: 100%;
                    max-width: 600px;
                    background: var(--card-bg);
                    border-radius: 16px;
                    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
                    margin: 0 auto;
                    overflow: hidden;
                }
                /* ヘッダー部分 */
                .profile-header {
                    background: linear-gradient(45deg, var(--theme-color), #818cf8);
                    padding: 2.5rem 1rem 4rem;
                    position: relative;
                    color: white;
                    text-align: center;
                    border-radius: 16px 16px 0 0;
                }
                .avatar-wrapper {
                    position: absolute;
                    width: 120px;
                    height: 120px;
                    bottom: -60px;
                    left: 50%;
                    transform: translateX(-50%);
                    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                    border-radius: 50%;
                }

                .avatar-progress {
                    width: 100%;
                    height: 100%;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .avatar {
                    width: 105px; 
                    height: 105px;
                    border-radius: 50%;
                }

                /* プロフィール本体 */
                .profile-body {
                    padding: 80px 30px 30px;
                    text-align: center;
                }
                .user-name { font-size: 1.8rem; font-weight: 700; margin: 0; }
                .user-level { font-size: 1rem; font-weight: 500; color: var(--theme-color); margin-top: 8px; }
                .user-bio { font-size: 1rem; color: var(--sub-text-color); margin-top: 1rem; }
                
                /* --- タブ機能のスタイル --- */
                .tab-nav {
                    display: flex;
                    border-bottom: 2px solid var(--border-color);
                    margin: 2rem 0 1.5rem;
                }
                .tab-button {
                    flex: 1;
                    padding: 1rem 0.5rem;
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 1rem;
                    font-weight: 600;
                    color: var(--sub-text-color);
                    position: relative;
                    transition: color 0.3s ease;
                }
                .tab-button.active {
                    color: var(--theme-color);
                }
                .tab-button::after {
                    content: '';
                    position: absolute;
                    bottom: -2px;
                    left: 0;
                    width: 100%;
                    height: 2px;
                    background: var(--theme-color);
                    transform: scaleX(0);
                    transition: transform 0.3s ease;
                }
                .tab-button.active::after {
                    transform: scaleX(1);
                }
                .tab-content {
                    display: none; /* 初期状態では非表示 */
                    text-align: left;
                    animation: fadeIn 0.4s ease;
                }
                .tab-content.active {
                    display: block; /* アクティブなタブだけ表示 */
                }
                .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1.5rem; text-align: center; }
                .stat-item .value { font-size: 1.5rem; font-weight: 700; }
                .stat-item .label { font-size: 0.9rem; color: var(--sub-text-color); }
                .badges-grid { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; }
                .badge-item { display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center; }
                .badge-icon { font-size: 2.5rem; line-height: 1; }
                .badge-name { font-size: 0.8rem; color: var(--sub-text-color); margin-top: 0.5rem; }
                @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
                /* 戻るボタンのスタイル */
                .back-link {
                    display: inline-block;
                    margin-top: 2rem;
                    color: var(--sub-text-color, #777);
                    text-decoration: none;
                    font-weight: 500;
                }
                .back-link:hover {
                    text-decoration: underline;
                }
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.7);
                    display: none; /* 初期状態は非表示 */
                    justify-content: center;
                    align-items: center;
                    z-index: 1000;
                    animation: fadeIn 0.3s ease;
                }
                .modal-content {
                    background: white;
                    padding: 2rem;
                    border-radius: 12px;
                    text-align: center;
                    width: 90%;
                    max-width: 400px;
                    position: relative;
                }
                .modal-icon {
                    font-size: 4rem;
                }
                .modal-title {
                    font-size: 1.5rem;
                    font-weight: 600;
                    margin: 1rem 0;
                }
                .modal-description {
                    color: var(--sub-text-color);
                }
                .modal-close {
                    position: absolute;
                    top: 10px;
                    right: 15px;
                    font-size: 1.8rem;
                    cursor: pointer;
                    color: #ccc;
                    background: none;
                    border: none;
                }
                .modal-close:hover {
                    color: #999;
                }

                .badge-trigger {
                    text-decoration: none; 
                    color: #333; 
                    border-bottom: 1px solid #ccc; 
                    transition: all 0.2s ease; 
                }

                .badge-trigger:hover {
                    color: #007bff; 
                    border-bottom-color: #007bff; 
                }

                .badge-item.locked {
                    filter: grayscale(100%); 
                    opacity: 0.6;            
                }

                .badge-item.locked .badge-name {
                    color: #a0aec0; 
                }
            </style>

        <div class="profile-card">
            <header class="profile-header">
                <div class="avatar-wrapper">
                    <div class="avatar-progress" style="background: conic-gradient(var(--theme-color) {{ $user->profile->level_progress ?? 0 }}%, #e9ecef 0);">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('default_avatar.png') }}" alt="User Icon" class="avatar">
                    </div>
                </div>
            </header>

        <main class="profile-body">
            <div class="user-info">
                <h1 class="user-name">{{ $user->name }}</h1>
                <div class="user-level">Level. {{ $user->profile->level }}</div>
                <p class="user-bio">
                    @if ($user->bio)
                        "{{ $user->bio }}"
                    @else
                        <span style="color: #999;">一言コメントはまだ設定されていません。</span>
                    @endif
                </p>
            </div>

            <nav class="tab-nav">
                <button class="tab-button active" data-tab="stats">クイズ成績</button>
                <button class="tab-button" data-tab="badges">称号・バッジ</button>
            </nav>

            <div class="tab-content active" id="stats">
                <div class="stats-grid">
                    <div class="stat-item"><div class="value">{{ number_format($user->profile->total_score) }}</div><div class="label">累計スコア</div></div>
                    <div class="stat-item"><div class="value">{{ $user->profile->total_plays }}</div><div class="label">総プレイ回数</div></div>
                    <div class="stat-item"><div class="value">{{ $user->profile->accuracy }}%</div><div class="label">正答率</div></div>
                </div>
                
                 <div class="stats-grid" style="margin-top: 1.5rem;">
                    <div class="stat-item"><div class="value">{{ $user->profile->favorite_genre ?? '未設定' }}</div><div class="label">得意ジャンル</div></div>
                    <div class="stat-item"><div class="value">{{ $user->profile->weakest_genre ?? '未設定' }}</div><div class="label">苦手ジャンル</div></div>
                </div>
            </div>

            <div class="tab-content" id="badges">
                <div class="badges-grid">
                    @foreach ($allBadges as $badge)
                        @php
                            $isAcquired = $userBadgeIds->contains($badge->id);
                        @endphp
                    <a href="#" 
                class="badge-trigger"
                data-icon="{{ $badge->icon }}"
                data-name="{{ $badge->name }}"
                data-description="{{ $badge->description }}">
                
                <div class="badge-item {{ $isAcquired ? '' : 'locked' }}">
                    <div class="badge-icon">{{ $badge->icon }}</div>
                    <div class="badge-name">{{ $badge->name }}</div>
                </div>
            </a>
                @endforeach
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('profile.edit') }}" style="display:inline-block; padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 8px;">
                    プロフィールを編集
                </a>
            </div>

        </main>
    </div>

    <div id="badge-modal" class="modal-overlay">
        <div class="modal-content">
            <button id="modal-close-button" class="modal-close">&times;</button>
            <div id="modal-badge-icon" class="modal-icon"></div>
            <h2 id="modal-badge-name" class="modal-title"></h2>
            <p id="modal-badge-description" class="modal-description"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // すべてのボタンとコンテンツから 'active' クラスを削除
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // クリックされたボタンと対応するコンテンツに 'active' クラスを追加
                button.classList.add('active');
                document.getElementById(button.dataset.tab).classList.add('active');
            });
        });

        const badgeModal = document.getElementById('badge-modal');
            const badgeTriggers = document.querySelectorAll('.badge-trigger');
            const closeModalButton = document.getElementById('modal-close-button');

            // 各バッジがクリックされた時の処理
            badgeTriggers.forEach(trigger => {
                trigger.addEventListener('click', function (event) {
                    event.preventDefault(); // リンクのデフォルト動作をキャンセル

                    // クリックされたバッジの情報をdata属性から取得
                    const icon = this.dataset.icon;
                    const name = this.dataset.name;
                    const description = this.dataset.description;

                    // モーダルの内容を書き換える
                    document.getElementById('modal-badge-icon').innerText = icon;
                    document.getElementById('modal-badge-name').innerText = name;
                    document.getElementById('modal-badge-description').innerText = description;

                    // モーダルを表示する
                    badgeModal.style.display = 'flex';
                });
            });

            // 閉じるボタンがクリックされた時の処理
            closeModalButton.addEventListener('click', function () {
                badgeModal.style.display = 'none';
            });

            // 背景がクリックされた時も閉じる
            badgeModal.addEventListener('click', function (event) {
                if (event.target === badgeModal) {
                    badgeModal.style.display = 'none';
                }
            });
        });
    </script>
    </div>
    </div>
</x-app-layout>