<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold">商品新規登録</h2>
  </x-slot>

  <form method="POST"
        action="{{ route('products.store') }}"
        enctype="multipart/form-data"
        class="space-y-6">
    @csrf

    {{-- 画面上部のまとめエラー --}}
    @if ($errors->any())
      <div class="rounded-md bg-red-50 border border-red-200 p-4 text-red-700">
        <p class="font-semibold mb-2">入力に誤りがあります。下記をご確認ください。</p>
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @include('products._form')

    <div class="flex gap-3 pt-2">
      <button type="submit"
              class="inline-flex items-center px-4 py-2 border border-slate-700 rounded hover:bg-slate-50">
        登録
      </button>
      <a href="{{ route('products.index') }}"
         class="inline-flex items-center px-4 py-2 border border-slate-400 rounded hover:bg-slate-50">
        戻る
      </a>
    </div>
  </form>
</x-app-layout>