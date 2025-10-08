<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
    // 一覧（検索 + 並び替え + ページネーション）
    public function index(Request $request)
    {
        $q      = $request->input('q');           // 部分一致キーワード（仕様書 3-3）
        $maker  = $request->input('maker');       // メーカーセレクト（仕様書 3-3）
        $sort   = $request->input('sort', 'id');  // 並び替えキー（任意）
        $order  = $request->input('order', 'asc');// 並び順（asc/desc）

        $query = Product::query();

        if (!empty($q)) {
            $query->where(function($qq) use ($q) {
                $qq->where('name', 'like', "%{$q}%")
                   ->orWhere('maker', 'like', "%{$q}%");
            });
        }

        if (!empty($maker)) {
            $query->where('maker', $maker);
        }

        // 並び替え許可カラムの制限（安全対策）
        $sortable = ['id', 'name', 'price', 'stock', 'maker', 'created_at'];
        if (!in_array($sort, $sortable, true)) {
            $sort = 'id';
        }
        $order = $order === 'desc' ? 'desc' : 'asc';

        $products = $query->orderBy($sort, $order)
                          ->paginate(10)
                          ->withQueryString(); // ページングリンクに検索条件維持

        // セレクトボックス用メーカー一覧（重複排除・アルファベット順）
        $makers = Product::select('maker')->distinct()->orderBy('maker')->pluck('maker');

        return view('products.index', compact('products', 'q', 'maker', 'makers', 'sort', 'order'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:255'],
            'maker'   => ['required','string','max:255'],
            'price'   => ['required','integer','min:0'],
            'stock'   => ['required','integer','min:0'],
            'comment' => ['nullable','string'],
            'image'  => ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:2048'],
        ], [], [
            'name'  => '商品名',
            'maker' => 'メーカー',
            'price' => '価格',
            'image' => '商品画像',
            'stock' => '在庫数',
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('status', '登録しました');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:255'],
            'maker'   => ['required','string','max:255'],
            'price'   => ['required','integer','min:0'],
            'stock'   => ['required','integer','min:0'],
            'comment' => ['nullable','string'],
            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
        ], [], [
            'name'  => '商品名',
            'maker' => 'メーカー',
            'price' => '価格',
            'stock' => '在庫数',
            'image' => '商品画像',
        ]);

    if ($request->hasFile('image')) {

         if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);

    $data['image_path'] = $request->file('image')->store('products', 'public');
}

$product->update($data);

    return redirect()
        ->route('products.index')
        ->with('status', '更新しました');

    Product::create($data);

    return redirect()->route('products.index')->with('status', '登録しました');
}

        $product->update($data);

        return redirect()->route('products.index')->with('status', '更新しました');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('status', '削除しました');
    }
}
