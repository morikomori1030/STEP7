<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>商品一覧</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui, "Segoe UI", Roboto; margin:2rem;}
    table{border-collapse:collapse; width:100%; max-width:900px}
    th,td{border:1px solid #ddd; padding:.6rem; text-align:left}
    th{background:#f6f6f6}
    .empty{color:#777}
    .btn{padding:0.3em 0.6em; margin:0 0.2em; border-radius:4px; text-decoration:none;}
    .btn-info{background:#17a2b8; color:#fff;}
    .btn-warning{background:#ffc107; color:#000;}
    .btn-danger{background:#dc3545; color:#fff;}
  </style>
</head>
<body>
  <h1>商品一覧</h1>

  <p>
  <a href="{{ route('products.create') }}" style="display:inline-block;padding:.6rem 1rem;background:#0ea5e9;color:#fff;border-radius:.5rem;text-decoration:none;">新規登録</a>
  </p>

  @if($products->isEmpty())
    <p class="empty">商品がまだ登録されていません。</p>
  @else
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
        @foreach($products as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->maker }}</td>
            <td>{{ number_format($p->price) }}</td>
            <td>{{ $p->stock }}</td>
            <td>{{ $p->updated_at?->format('Y-m-d H:i') }}</td>
            <td>
              <a href="{{ route('products.show', $p) }}" class="btn btn-info">詳細</a>
              <a href="{{ route('products.edit', $p) }}" class="btn btn-warning">編集</a>
              <form action="{{ route('products.destroy', $p) }}" method="post" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</body>
</html>
