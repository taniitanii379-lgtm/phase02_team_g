<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <style>
        /* 基本的な変数はそのまま */
        :root {
            --theme-color: {{ $user->profile->theme_color ?? '#2fcb85ff' }};
            --card-bg: #ffffff;
            --text-color: #333;
            --sub-text-color: #777;
            --border-color: #eee;
        }
        body {
            font-family: 'Helvetica Neue', Arial, 'Hiragino Kaku Gothic ProN', sans-serif;
            background-color: #f0f2f5;
            color: var(--text-color);
            padding: 2rem 0;
            display: flex;
            justify-content: center;
        }
        /* カード全体のスタイル */
        .profile-card {
            width: 100%;
            max-width: 600px;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 8px
 30px rgba(0,0,0,0.12);
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
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            background-color: #e0e0e0;
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
        /* ----------------------- */

        /* 各セクションのスタイルはそのまま活用 */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1.5rem; text-align: center; }
        .stat-item .value { font-size: 1.5rem; font-weight: 700; }
        .stat-item .label { font-size: 0.9rem; color: var(--sub-text-color); }
        .badges-grid { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; }
        .badge-item { display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center; }
        .badge-icon { font-size: 2.5rem; line-height: 1; }
        .badge-name { font-size: 0.8rem; color: var(--sub-text-color); margin-top: 0.5rem; }
        
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>

    <style>
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
    </style>
</head>
<body>

    <div class="profile-card">
        <header class="profile-header">
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('default_avatar.png') }}" alt="User Icon" class="avatar">
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
                    @forelse ($user->badges as $badge)
                        <div class="badge-item" title="{{ $badge->description }}">
                            <div class="badge-icon">{{ $badge->icon }}</div>
                            <div class="badge-name">{{ $badge->name }}</div>
                        </div>
                    @empty
                        <p>まだ達成したバッジはありません。</p>
                    @endforelse
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('profile.edit') }}" style="display:inline-block; padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 8px;">
                    プロフィールを編集
                </a>
            </div>

            <a href="{{ url()->previous() }}" class="back-link">
                &laquo; 前のページに戻る
            </a>
        </main>
    </div>

    <script>
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
    </script>

</body>
</html>