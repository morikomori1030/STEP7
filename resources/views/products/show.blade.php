<h1>商品 詳細</h1>

<dl>
    <dt>ID</dt><dd>{{ $product->id }}</dd>
    <dt>商品名</dt><dd>{{ $product->name }}</dd>
    <dt>メーカー</dt><dd>{{ $product->maker }}</dd>
    <dt>価格</dt><dd>{{ number_format($product->price) }} 円</dd>
    <dt>在庫数</dt><dd>{{ $product->stock }}</dd>
    <dt>コメント</dt><dd>{{ $product->comment }}</dd>
    <dt>更新日</dt><dd>{{ $product->updated_at->format('Y-m-d H:i') }}</dd>
</dl>


@if (!empty($product->image_path))
    <div style="margin-top: 1rem;">
        <img src="{{ asset('storage/' . $product->image_path) }}" 
             alt="商品画像" 
             style="max-width: 300px; border: 1px solid #ccc; border-radius: 8px;">
    </div>
@else
    <p style="color: #777;">画像は登録されていません。</p>
@endif

<p style="margin-top:1rem;">
    <a class="btn" href="{{ route('products.edit', $product) }}">編集</a>
    <a class="btn" href="{{ route('products.index') }}">戻る</a>
</p>
<style>
.btn {
    display: inline-block;
    padding: 0.6rem 1.4rem;
    border: 1px solid #ccc;
    background-color: #f8f8f8;
    color: #4b0082; /* 紫系テキストカラー */
    text-decoration: none;
    font-size: 1rem;
    border-radius: 4px;
    transition: 0.2s;
}

.btn:hover {
    background-color: #e9e9e9;
    border-color: #999;
}
</style>