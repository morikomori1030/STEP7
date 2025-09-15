@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="h4 mb-3">商品詳細</h1>

  <table class="table table-bordered">
    <tr>
      <th>ID</th>
      <td>{{ $product->id }}</td>
    </tr>
    <tr>
      <th>商品名</th>
      <td>{{ $product->name }}</td>
    </tr>
    <tr>
      <th>メーカー</th>
      <td>{{ $product->maker }}</td>
    </tr>
    <tr>
      <th>価格</th>
      <td>¥{{ number_format($product->price) }}</td>
    </tr>
    <tr>
      <th>在庫数</th>
      <td>{{ $product->stock }}</td>
    </tr>
    <tr>
      <th>コメント</th>
      <td>{{ $product->comment }}</td>
    </tr>
    <tr>
      <th>登録日</th>
      <td>{{ $product->created_at->format('Y-m-d H:i') }}</td>
    </tr>
    <tr>
      <th>更新日</th>
      <td>{{ $product->updated_at->format('Y-m-d H:i') }}</td>
    </tr>
  </table>

  <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">編集</a>

  <form action="{{ route('products.destroy', $product) }}" method="post" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
  </form>

  <a href="{{ route('products.index') }}" class="btn btn-secondary">一覧に戻る</a>
</div>
@endsection
