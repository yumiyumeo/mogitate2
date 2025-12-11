<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->paginate(6);
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword','');
        $order = $request->input('order', null);
        $price_filter = $request->input('price_filter', null);

        $query = Product::query();

        if ($keyword !== '') {
            $query->where('name','like','%'.trim($keyword).'%');
        }

        if ($price_filter) {
            // price_filter like "1001-5000"
            [$min,$max] = explode('-', $price_filter);
            $query->whereBetween('price', [(int)$min, (int)$max]);
        }

        if ($order === 'price_asc') {
            $query->orderBy('price','asc');
        } elseif ($order === 'price_desc') {
            $query->orderBy('price','desc');
        } else {
            $query->orderBy('created_at','desc');
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('products.search', [
            'products' => $products,
            'keyword' => $keyword,
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'price' => 'required|integer',
        'seasons' => 'required|array',
        'description' => 'required|max:120',
        'image' => 'required|image|max:2048',
    ]);

    // 画像保存
    $imageName = $request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('public/products', $imageName);

    // DB保存
    Product::create([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'seasons' => $validated['seasons'],
        'description' => $validated['description'],
        'image' => $imageName,
    ]);

    return redirect()->route('products.index');
}

    public function edit(Product $product)
    {
        // ensure seasons array accessible
        $product->seasons = $product->seasons ?? [];
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required',
        'price' => 'required|integer',
        'seasons' => 'required|array',
        'description' => 'required|max:120',
        'image' => 'image|max:2048',
    ]);

    // 画像更新
    if ($request->hasFile('image')) {
        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/products', $imageName);
        $product->image = $imageName;
    }

    $product->update([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'seasons' => $validated['seasons'],
        'description' => $validated['description'],
        'image' => $product->image,
    ]);

    return redirect()->route('products.index');
}

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();
        return redirect()->route('products.index');
    }
}
