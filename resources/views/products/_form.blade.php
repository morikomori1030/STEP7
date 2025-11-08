<div class="grid grid-cols-12 gap-6">

{{-- 商品名 --}}
  <div class="col-span-12 md:col-span-4">
    <label class="block text-sm font-medium">商品名 <span class="text-red-500">*</span></label>
    <input type="text" name="product_name" value="{{ old('product_name') }}"
           class="mt-1 block w-full rounded border p-2" />
    @error('product_name')
      <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- メーカー --}}
  <div class="col-span-12 md:col-span-4">
    <label class="block text-sm font-medium">メーカー <span class="text-red-500">*</span></label>
    <select name="company_id" class="mt-1 block w-full rounded border p-2">
      <option value="" disabled {{ old('company_id')==='' ? 'selected' : '' }}>選択してください</option>
      @foreach($companies as $c)
        <option value="{{ $c->id }}" {{ old('company_id') == $c->id ? 'selected' : '' }}>
          {{ $c->company_name }}
        </option>
      @endforeach
    </select>
    @error('company_id')
      <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- 価格 --}}
  <div class="col-span-12 md:col-span-2">
    <label class="block text-sm font-medium">価格 <span class="text-red-500">*</span></label>
    <input type="number" name="price" min="0" value="{{ old('price') }}"
           class="mt-1 block w-full rounded border p-2" />
    @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  {{-- 在庫数 --}}
  <div class="col-span-12 md:col-span-2">
    <label class="block text-sm font-medium">在庫数 <span class="text-red-500">*</span></label>
    <input type="number" name="stock" min="0" value="{{ old('stock') }}"
           class="mt-1 block w-full rounded border p-2" />
    @error('stock') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  {{-- コメント --}}
  <div class="col-span-12">
    <label class="block text-sm font-medium">コメント</label>
    <textarea name="comment" rows="4"
              class="mt-1 block w-full rounded border p-2">{{ old('comment') }}</textarea>
    @error('comment') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  {{-- 画像 --}}
  <div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium">商品画像</label>
    <input type="file" name="img_path" accept="image/*" class="mt-1 block w-full" />
    @error('img_path') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>
</div>
