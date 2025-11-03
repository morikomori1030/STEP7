<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品詳細（商品情報ID： {{ $number }}）
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl p-8 space-y-8">

                {{-- 画像＋基本情報 --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- 商品画像 --}}
                    <div class="flex items-start justify-center">
                        @php
                            $src = $product->img_path
                                   ? asset('storage/'.$product->img_path)
                                   : 'https://placehold.co/240x240?text=no+image';
                        @endphp
                        <img src="{{ $src }}"
                             alt="product image"
                             class="w-60 h-60 object-cover rounded-xl border border-gray-200">
                    </div>

                    {{-- テキスト情報 --}}
                    <div class="md:col-span-2 grid grid-cols-1 gap-6">
                        <div>
                            <div class="text-sm text-gray-500">商品名</div>
                            <div class="mt-1 text-lg font-semibold text-gray-900">
                                {{ $product->product_name }}
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <div class="text-sm text-gray-500">価格</div>
                                <div class="mt-1 text-lg font-semibold text-gray-900">
                                    ￥{{ number_format($product->price) }}
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">在庫数</div>
                                <div class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ $product->stock }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <div class="text-sm text-gray-500">メーカー名</div>
                                <div class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ $product->company?->company_name ?? '—' }}
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">商品情報ID</div>
                                <div class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ $number }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="text-sm text-gray-500">コメント</div>
                            <div class="mt-1 whitespace-pre-line text-gray-900">
                                {{ $product->comment ?: '（なし）' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                    class="btn-primary bg-blue-500 hover:bg-blue-600 text-white w-28 h-12 rounded-xl inline-flex justify-center items-center">
                    編集
                    </a>

                    <a href="{{ route('products.index') }}"
                       class="btn-secondary border border-gray-300 text-gray-700 hover:bg-gray-50 w-28 h-12 rounded-xl inline-flex justify-center items-center">
                        戻る
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>