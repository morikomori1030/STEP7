<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>商品 編集</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>body{font-family:system-ui;margin:2rem} .btn{padding:.5rem 1rem;border:1px solid #ccc}</style>
</head>
<body>
  <h1>商品 編集</h1>

  <form action="{{ route('products.update', $product) }}" method="post" style="display:grid;gap:.8rem;max-width:640px">
    @method('PUT')
    @include('products._form')
    <div style="display:flex;gap:.5rem">
      <button class="btn" type="submit">更新</button>
      <a class="btn" href="{{ route('products.index') }}">戻る</a>
    </div>
  </form>
</body>
</html>
