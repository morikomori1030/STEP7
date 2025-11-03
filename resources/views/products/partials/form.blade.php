<div class="space-y-3">
    <div>
        <label class="block text-sm">会社</label>
        <select name="company_id" class="w-full border rounded p-2" required>
            <option value="">選択してください</option>
            @foreach($companies as $c)
                <option value="{{ $c->id }}" @selected(old('company_id', optional($product)->company_id) == $c->id)>
                    {{ $c->company_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm">商品名</label>
        <input name="product_name" class="w-full border rounded p-2"
               value="{{ old('product_name', optional($product)->product_name) }}" required>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <div>
            <label class="block text-sm">価格</label>
            <input type="number" name="price" class="w-full border rounded p-2"
                   value="{{ old('price', optional($product)->price) }}" min="0" required>
        </div>
        <div>
            <label class="block text-sm">在庫</label>
            <input type="number" name="stock" class="w-full border rounded p-2"
                   value="{{ old('stock', optional($product)->stock) }}" min="0" required>
        </div>
    </div>

    <div>
        <label class="block text-sm">コメント</label>
        <textarea name="comment" class="w-full border rounded p-2" rows="3">{{ old('comment', optional($product)->comment) }}</textarea>
    </div>

    <div>
        <label class="block text-sm">画像パス（任意）</label>
        <input name="img_path" class="w-full border rounded p-2"
               value="{{ old('img_path', optional($product)->img_path) }}">
    </div>
</div>