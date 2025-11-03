<x-app-layout>
  <x-slot name="header">
    <h1 class="text-2xl font-semibold mb-6">商品情報編集（商品情報ID：{{ $displayId }}）</h1>
  </x-slot>

  {{-- バリデーションエラー --}}
  @if ($errors->any())
    <div class="mb-6 rounded-md bg-red-50 p-4 text-red-700">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      {{-- 商品情報ID（固定表示） --}}
      <div>
        <label class="block text-sm text-slate-500 mb-1">商品情報ID（固定表示）</label>
        <div class="text-lg font-medium">{{ $displayId }}</div>
      </div>

      {{-- 商品名（テキストボックス） --}}
      <div>
        <label for="product_name" class="block text-sm text-slate-600 mb-1">商品名 <span class="text-red-500">*</span></label>
        <input id="product_name" name="product_name" type="text"
               class="form-input"
               value="{{ old('product_name', $product->product_name) }}" required>
      </div>

      {{-- メーカー（セレクトボックス） --}}
      <div>
        <label for="company_id" class="block text-sm text-slate-600 mb-1">メーカー <span class="text-red-500">*</span></label>
        <select id="company_id" name="company_id" class="form-input" required>
          <option value="" disabled {{ old('company_id', $product->company_id) ? '' : 'selected' }}>選択してください</option>
          @foreach ($companies as $c)
            <option value="{{ $c->id }}" @selected(old('company_id', $product->company_id) == $c->id)>
              {{ $c->company_name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- 価格（テキストボックス：数値） --}}
      <div>
        <label for="price" class="block text-sm text-slate-600 mb-1">価格 <span class="text-red-500">*</span></label>
        <input id="price" name="price" type="number" min="0" step="1"
               class="form-input"
               value="{{ old('price', $product->price) }}" required>
      </div>

      {{-- 在庫数（テキストボックス：数値） --}}
      <div>
        <label for="stock" class="block text-sm text-slate-600 mb-1">在庫数 <span class="text-red-500">*</span></label>
        <input id="stock" name="stock" type="number" min="0" step="1"
               class="form-input"
               value="{{ old('stock', $product->stock) }}" required>
      </div>

      {{-- コメント（テキストエリア） --}}
      <div>
        <label for="comment" class="block text-sm text-slate-600 mb-1">コメント</label>
        <textarea id="comment" name="comment" rows="4" class="form-input">{{ old('comment', $product->comment) }}</textarea>
      </div>

      {{-- 商品画像（ファイルセレクタ） --}}
      <div>
        <label for="img_path" class="block text-sm text-slate-600 mb-2">商品画像（任意）</label>

        {{-- 現在の画像プレビュー --}}
        <div class="mb-3">
          @if ($product->img_path)
            <img src="{{ asset('storage/'.$product->img_path) }}" alt="current image"
                 class="h-24 w-24 object-cover rounded border"/>
          @else
            <div class="h-24 w-24 grid place-items-center rounded border text-slate-400 bg-slate-50">
              no image
            </div>
          @endif
        </div>

        <input id="img_path" name="img_path" type="file" accept="image/*" class="block">
        <p class="text-xs text-slate-500 mt-1">jpg / jpeg / png / gif / webp（最大 2MB）</p>
      </div>

      {{-- ボタン --}}
      <div class="flex gap-3 pt-2">
        <button type="submit" class="btn-primary">更新</button>
        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn-secondary">戻る</a>
      </div>
    </form>
  </div>
</div>
</x-app-layout>