<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 一覧（検索/並び替え/ページネーション）
    public function index(Request $request)
    {
        $q     = $request->input('q');              // フリーワード
        $sort  = $request->input('sort','id');      // 並び替えキー
        $order = $request->input('order','asc');    // asc / desc

        $query = Product::query();

        if ($q) {
            $query->where(function($qq) use ($q) {
                $qq->where('name','like',"%$q%")
                   ->orWhere('maker','like',"%$q%");
            });
        }

        // 許可する並び替えカラムを限定
        $sortable = ['id','name','price','stock','maker','created_at'];
        if (!in_array($sort,$sortable)) $sort = 'id';
        $order = $order === 'desc' ? 'desc' : 'asc';

        $products = $query->orderBy($sort,$order)->paginate(10)->withQueryString();

        return view('products.index', compact('products','q','sort','order'));
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
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('status','登録しました');
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
        ]);

        $product->update($data);
        return redirect()->route('products.index')->with('status','更新しました');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('status','削除しました');
    }
}
