@csrf

<div>
  <label>商品名 <span style="color:#ef4444">＊</span></label><br>
  <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}">
  @error('name')<div style="color:#ef4444">{{ $message }}</div>@enderror
</div>

<div>
  <label>メーカー <span style="color:#ef4444">＊</span></label><br>
  <input type="text" name="maker" value="{{ old('maker', $product->maker ?? '') }}">
  @error('maker')<div style="color:#ef4444">{{ $message }}</div>@enderror
</div>

<div>
  <label>価格 <span style="color:#ef4444">＊</span></label><br>
  <input type="number" name="price" value="{{ old('price', $product->price ?? 0) }}" min="0">
  @error('price')<div style="color:#ef4444">{{ $message }}</div>@enderror
</div>

<div>
  <label>在庫 <span style="color:#ef4444">＊</span></label><br>
  <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0">
  @error('stock')<div style="color:#ef4444">{{ $message }}</div>@enderror
</div>

<div class="mt-4">
  <label class="block text-sm font-medium text-gray-700">商品画像</label>
  <input type="file" name="image" accept="image/*"
        class="mt-1 block w-full border rounded p-2">
  @error('image')
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
  @enderror

        {{-- 編集時は現在画像のプレビュー --}}
        @isset($product)
            @if($product->image_path)
                <img src="{{ asset('storage/'.$product->image_path) }}"
                     alt="商品画像" class="mt-2 h-24 rounded object-cover">
            @endif
        @endisset
</div>

<div>
  <label>コメント</label><br>
  <textarea name="comment" rows="4">{{ old('comment', $product->comment ?? '') }}</textarea>
  @error('comment')<div style="color:#ef4444">{{ $message }}</div>@enderror
</div>
