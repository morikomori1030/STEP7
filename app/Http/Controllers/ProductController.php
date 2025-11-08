<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 一覧
    public function index()
    {
        $products  = Product::with('company')
                        ->filter(request())
                        ->orderByDesc('id')
                        ->paginate(10);

        $companies = Company::orderBy('id')->get();

        return view('products.index', compact('products', 'companies'));
    }

    // 新規作成フォーム
    public function create()
    {
        $companies = Company::orderBy('company_name')->get(['id','company_name']);
        $product   = null; // _form のため

        return view('products.create', compact('companies', 'product'));
    }

    // 登録
    public function store(ProductRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('img_path')) {
        $data['img_path'] = $request->file('img_path')->store('products', 'public');
    }

    Product::create($data);

    return redirect()->route('products.index')
        ->with('status', '商品を登録しました。');
}

    // 詳細
   public function show(Product $product)
{
    
    $displayId = Product::orderBy('id','desc')
    ->pluck('id')
    ->search($product->id) + 1;

    return view('products.show', [
        'product'   => $product->load('company'),
        'displayId' => $displayId,
    ]);
}

    // 編集フォーム
    public function edit(Product $product)
{
    $companies = Company::all();

    $displayId = Product::orderBy('id', 'desc')
        ->pluck('id')
        ->search($product->id) + 1;

    return view('products.edit', [
        'product' => $product,
        'companies' => $companies,
        'displayId' => $displayId,
    ]);
}

    // 更新
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            if ($product->img_path) {
                Storage::disk('public')->delete($product->img_path);
            }
            $data['img_path'] = $request->file('img_path')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.show', $product)
            ->with('status', '商品を更新しました。');
    }

    // 削除
    public function destroy(Product $product)
    {
    try {
        $product->delete();
        return redirect()->route('products.index')->with('status', '商品を削除しました。');
    } catch (\Throwable $e) {
        report($e);
        return back()->withErrors(['system' => '削除に失敗しました。時間をおいて再度お試しください。']);
    }
    }
}
