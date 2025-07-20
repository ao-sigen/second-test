<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Season;



class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query(); // ← クラス名は Product（単数形）に修正

        // 検索（部分一致）
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え（高い順 or 低い順）
        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->Paginate(6)->withQueryString();

        return view('products.index', [
            'products' => $products,
            'keyword' => $request->keyword,
            'sort' => $request->sort,
        ]);
    }

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();  // 季節一覧を取得

        $productSeasons = $product->seasons->pluck('id')->toArray();

        return view('products.show', compact('product', 'seasons', 'productSeasons'));
    }

    // createメソッド
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {

        // データ更新
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // 季節（多対多）の更新
        $product->seasons()->sync($request->season);

        // 画像処理（任意）
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }

    public function store(StoreProductRequest $request)
    {
        // 画像アップロード（storage/app/public/products）
        $path = null;
        if ($request->file('image')) {
            $path = $request->file('image')->store('products', 'public');
        }
        // 商品登録
        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'image'       => $path,
            'description' => $request->description,
        ]);
        if ($request->filled('season')) {
            $product->seasons()->attach($request->season);
        }
        // 中間テーブルへ季節を登録
        $product->seasons()->attach($request->season); // 配列OK

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }


    public function destroy(Request $request)
    {
        product::find($request->id)->delete();
        return redirect('/')->with('message', '削除しました');
    }
}
