{{-- 新規登録 --}}
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      商品 新規登録
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow rounded p-6">

        <form action="{{ route('products.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
          @csrf

          {{-- 商品名（テキストボックス） --}}
          <div>
            <label class="block text-sm text-slate-600 mb-1">商品名 <span class="text-red-600">*</span></label>
            <input type="text" name="product_name" value="{{ old('product_name') }}"
                   class="w-full rounded border-slate-300" />
            @error('product_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- メーカー（セレクトボックス） --}}
          <div>
            <label class="block text-sm text-slate-600 mb-1">メーカー <span class="text-red-600">*</span></label>
            <select name="company_id" class="w-full rounded border-slate-300">
              <option value="">選択してください</option>
              @foreach ($companies as $c)
                <option value="{{ $c->id }}" @selected(old('company_id')==$c->id)>{{ $c->company_name }}</option>
              @endforeach
            </select>
            @error('company_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- 価格（テキストボックス／数値） --}}
          <div>
            <label class="block text-sm text-slate-600 mb-1">価格 <span class="text-red-600">*</span></label>
            <input type="number" name="price" value="{{ old('price') }}" min="0" step="1"
                   class="w-full rounded border-slate-300" />
            @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- 在庫数（テキストボックス／数値） --}}
          <div>
            <label class="block text-sm text-slate-600 mb-1">在庫数 <span class="text-red-600">*</span></label>
            <input type="number" name="stock" value="{{ old('stock') }}" min="0" step="1"
                   class="w-full rounded border-slate-300" />
            @error('stock') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- コメント（テキストエリア） --}}
          <div>
            <label class="block text-sm text-slate-600 mb-1">コメント</label>
            <textarea name="comment" rows="4" class="w-full rounded border-slate-300">{{ old('comment') }}</textarea>
            @error('comment') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- 商品画像（ファイルセレクタ） --}}
          <div>
            <label class="block text-sm text-slate-600 mb-1">商品画像</label>
            <input type="file" name="img" accept="image/*" class="block w-full text-sm" />
            @error('img') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="flex gap-3 pt-2">
            {{-- 登録ボタン（黒枠） --}}
            <button type="submit"
              class="inline-flex items-center px-4 py-2 border border-slate-700 rounded hover:bg-slate-50">
              登録
            </button>

            {{-- 戻るボタン（一覧へ） --}}
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center px-4 py-2 border border-slate-400 rounded hover:bg-slate-50">
              戻る
            </a>
          </div>
        </form>

      </div>
    </div>
  </div>
</x-app-layout>