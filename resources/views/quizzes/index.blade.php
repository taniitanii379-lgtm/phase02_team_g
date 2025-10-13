<!-- resources/views/quizzes/index.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クイズ一覧</title>
</head>
<body>
    <h1>クイズ一覧</h1>

    <!-- フラッシュメッセージ -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- 新規作成リンク -->
    <a href="{{ route('quizzes.create') }}">+ 新しいクイズを作成</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>問題文</th>
                <th>選択肢</th>
                <th>正解</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->question }}</td>
                    <td>
                        <ul>
                            @foreach ($quiz->choices as $index => $choice)
                                <li @if($index == $quiz->answer) style="font-weight: bold;" @endif>
                                    {{ $choice }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $quiz->choices[$quiz->answer] ?? '不明' }}</td>
                    <td>
                        <a href="{{ route('quizzes.edit', $quiz->id) }}">編集</a> |
                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">クイズがまだ登録されていません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>