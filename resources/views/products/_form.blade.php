@csrf
<div class="mb-3">
  <label class="form-label">商品名</label>
  <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
</div>
<div class="mb-3">
  <label class="form-label">メーカー</label>
  <input type="text" name="maker" class="form-control" value="{{ old('maker', $product->maker ?? '') }}" required>
</div>
<div class="mb-3">
  <label class="form-label">価格</label>
  <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? 0) }}" min="0" required>
</div>
<div class="mb-3">
  <label class="form-label">在庫</label>
  <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? 0) }}" min="0" required>
</div>
<div class="mb-3">
  <label class="form-label">コメント</label>
  <textarea name="comment" class="form-control">{{ old('comment', $product->comment ?? '') }}</textarea>
</div>
<button type="submit" class="btn btn-primary">保存</button>
<a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
