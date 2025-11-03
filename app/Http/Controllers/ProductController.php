<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::with('company');

    // 商品名検索
    if ($request->filled('name')) {
        $query->where('product_name', 'like', '%' . $request->name . '%');
    }

    // 会社絞り込み
    if ($request->filled('company_id')) {
        $query->where('company_id', $request->company_id);
    }

    // 並び替え＆ページネーション
    $products = $query->orderByDesc('created_at')->paginate(10);

    $companies = Company::orderBy('company_name')
        ->get(['id', 'company_name']);

    return view('products.index', compact('products', 'companies'));
}

    public function create()
{
    $companies = Company::orderBy('company_name')->get(['id','company_name']);
    return view('products.create', compact('companies'));
}

public function store(Request $request)
{
    $data = $request->validate([
        'company_id'   => ['required', 'exists:companies,id'],
        'product_name' => ['required', 'string', 'max:255'],
        'price'        => ['required', 'integer', 'min:0'],
        'stock'        => ['required', 'integer', 'min:0'],
        'comment'      => ['nullable', 'string', 'max:1000'],
        'img'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5MB
    ]);

    // 画像保存（storage/app/public/products）
    $path = null;
    if ($request->hasFile('img')) {
        $path = $request->file('img')->store('products', 'public');
    }

    Product::create([
        'company_id'   => $data['company_id'],
        'product_name' => $data['product_name'],
        'price'        => $data['price'],
        'stock'        => $data['stock'],
        'comment'      => $data['comment'] ?? null,
        'img_path'     => $path, // 一覧で表示している img_path に保存
    ]);

    return redirect()->route('products.index')
        ->with('status', '商品を登録しました！');
}

    // 編集画面
    public function edit(Product $product)
{
    $companies = Company::orderBy('company_name')->get(['id','company_name']);

    $displayId = Product::orderBy('id', 'asc')
        ->pluck('id')
        ->search($product->id) + 1;

    return view('products.edit', compact('product', 'companies', 'displayId'));
}

    public function show(Product $product)
{
    $number = Product::orderBy('id', 'asc')
        ->pluck('id')
        ->search($product->id) + 1; 

    return view('products.show', compact('product', 'number'));
}

    // 更新
    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'product_name' => ['required','string','max:255'],  // テキストボックス
        'company_id'   => ['required','exists:companies,id'], // セレクトボックス
        'price'        => ['required','integer','min:0'],     // テキストボックス（数値）
        'stock'        => ['required','integer','min:0'],     // テキストボックス（数値）
        'comment'      => ['nullable','string','max:1000'],   // テキストエリア
        'img_path'     => ['nullable','image','mimes:jpg,jpeg,png,gif,webp','max:2048'], // ファイルセレクタ
    ]);

    // 画像がアップされたら置き換え
    if ($request->hasFile('img_path')) {
        if ($product->img_path) {
            Storage::disk('public')->delete($product->img_path);
        }
        $path = $request->file('img_path')->store('products', 'public');
        $validated['img_path'] = $path;
    }

    $product->update($validated);

    return redirect()
        ->route('products.show', $product)
        ->with('status', '商品を更新しました！');
}

    // 削除
    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('status','商品を削除しました！');
    }
}