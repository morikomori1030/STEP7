<div class="max-w-7xl mx-auto px-4 py-8">

  {{-- フラッシュメッセージ --}}
@if (session('status'))
    <div class="mb-4 rounded bg-green-50 border border-green-200 text-green-800 px-4 py-2">
        {{ session('status') }}
    </div>
@endif

<style>
  .title-row{ display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; }
</style>

<x-app-layout>
      <x-slot name="header">
        <div class="flex items-center justify-between mb-6">
          <h1 class="text-3xl font-bold">商品一覧</h1>
        </div>
      </x-slot>  

  <form method="GET" action="{{ route('products.index') }}" class="flex gap-4">
    <input type="text" name="name" value="{{ request('name') }}" placeholder="商品名" class="border rounded px-3 py-2 w-1/3">
    <select name="company_id" class="border rounded px-3 py-2 w-1/3">
        <option value="">メーカー名（すべて）</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}" @selected(request('company_id') == $company->id)>
                {{ $company->company_name }}
            </option>
        @endforeach
    </select>
    <button 
    type="submit" 
    class="bg-white text-black border border-gray-400 rounded px-4 py-2 hover:bg-gray-100 hover:border-gray-600 transition">
    検索
    </button>

    <a href="{{ route('products.create') }}"
    class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md shadow transition-colors duration-200">
    新規登録
    </a>
  </form>

  {{-- 一覧テーブル --}}
  <div class="mt-10">
  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full text-left">
      <thead class="border-b bg-slate-50">
        <tr class="text-sm text-slate-600">
          <th class="px-5 py-3 w-16">No.</th>
          <th class="px-5 py-3 w-28">商品画像</th>
          <th class="px-5 py-3">商品名</th>
          <th class="px-5 py-3 w-28">価格</th>
          <th class="px-5 py-3 w-24">在庫数</th>
          <th class="px-5 py-3 w-40">メーカー名</th>
          <th class="px-5 py-3 w-40">操作</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        @forelse ($products as $product)
          <tr class="align-middle">
            {{-- id（固定表示） --}}
            <td class="px-5 py-4 text-slate-700">{{ $loop->iteration }}</td>

            {{-- 商品画像（固定表示） --}}
            <td class="px-5 py-4">
              @if($product->img_path)
                <img src="{{ asset('storage/'.$p->img_path) }}"
                     alt="image"
                     class="h-16 w-16 object-cover rounded border" />
              @else
                <div class="h-16 w-16 grid place-items-center rounded border text-xs text-slate-400">
                  no image
                </div>
              @endif
            </td>

            {{-- 商品名（固定表示） --}}
            <td class="px-5 py-4 text-slate-900">{{ $product->product_name }}</td>

            {{-- 価格（固定表示） --}}
            <td class="px-5 py-4 tabular-nums">¥{{ number_format($product->price) }}</td>

            {{-- 在庫数（固定表示） --}}
            <td class="px-5 py-4 tabular-nums">{{ $product->stock }}</td>

            {{-- メーカー名（固定表示） --}}
            <td class="px-5 py-4 text-slate-700">
              {{ optional($product->company)->company_name ?? '—' }}
            </td>

            {{-- 操作：詳細ボタン／削除ボタン --}}
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">

            {{-- 詳細（青） --}}
            <a href="{{ route('products.show', $product->id) }}"
            class="inline-flex items-center justify-center
              w-24 h-10 rounded-md
              bg-blue-500 text-white hover:bg-blue-600
              font-semibold leading-none">
              詳細
            </a>

           {{-- 削除（赤） --}}
          <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="m-0" onsubmit="return confirm('本当に削除しますか？');">
           @csrf
           @method('DELETE')
          <button type="submit"
            class="inline-flex items-center justify-center
               w-24 h-10 rounded-md
               bg-red-500 text-white hover:bg-red-600
               font-semibold leading-none">
               削除
          </button>
          </form>
          </div>
          </td>
          </tr>
            @empty
          <tr>
            <td class="px-5 py-10 text-center text-slate-500" colspan="7">
              該当する商品がありません
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- ページネーション（クエリ維持） --}}
  <div class="mt-6">
    {{ $products->links() }}
  </div>
</div>
</x-app-layout>
</div>
