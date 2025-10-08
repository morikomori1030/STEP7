<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>商品一覧</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body { font-family: system-ui, -apple-system, "Segoe UI", Roboto; margin: 2rem; }
    table { border-collapse: collapse; width: 100%; max-width: 980px; }
    th, td { border: 1px solid #ddd; padding: .6rem; text-align: left; }
    th { background: #f6f6f6; }
    .toolbar { margin: 1rem 0; display: flex; gap: .5rem; align-items: center; }
    .btn { padding: .5rem 1rem; border: 1px solid #ccc; background: #fafafa; cursor: pointer; }
    .btn--primary { background: #0ea5e9; color: #fff; border-color: #0ea5e9; }
    .btn--danger  { background: #ef4444; color: #fff; border-color: #ef4444; }
    .status { color: #16a34a; margin-bottom: 1rem; }
  </style>
</head>
<body>
  <h1>商品一覧</h1>

  @if (session('status'))
    <p class="status">{{ session('status') }}</p>
  @endif

  <form method="get" class="toolbar" action="{{ route('products.index') }}">
    <input type="text" name="q" value="{{ $q }}" placeholder="検索キーワード">
    <select name="maker">
      <option value="">メーカーを選択</option>
      @foreach($makers as $m)
        <option value="{{ $m }}" @selected($maker === $m)>{{ $m }}</option>
      @endforeach
    </select>
    <button class="btn" type="submit">検索</button>

    <a class="btn btn--primary" href="{{ route('products.create') }}">新規登録</a>
  </form>

  <form method="POST" action="{{ route('logout') }}" style="position: fixed; bottom: 20px; right: 20px;">
    @csrf
    <button type="submit" 
        style="padding: 10px 20px; background-color: #f87171; color: white; border: none; border-radius: 5px; cursor: pointer;">
        ログアウト
    </button>
　</form>


  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>商品名</th>
        <th>メーカー</th>
        <th>価格</th>
        <th>在庫</th>
        <th>更新日</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($products as $p)
      <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->maker }}</td>
        <td>{{ number_format($p->price) }}</td>
        <td>{{ $p->stock }}</td>
        <td>{{ $p->updated_at?->format('Y-m-d H:i') }}</td>
        <td>
          <a class="btn" href="{{ route('products.show', $p) }}">詳細</a>
          <a class="btn" href="{{ route('products.edit', $p) }}">編集</a>
          <form action="{{ route('products.destroy', $p) }}" method="post" style="display:inline-block" onsubmit="return confirm('削除しますか？');">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">削除</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7">商品がまだ登録されていません。</td></tr>
    @endforelse
    </tbody>
  </table>

  <div style="margin-top:1rem">
    {{ $products->links() }}
  </div>
</body>
</html>
