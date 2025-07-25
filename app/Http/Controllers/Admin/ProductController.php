<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Hiển thị trang danh sách sản phẩm.
     */
    public function index()
    {
        $products = Product::with(['category', 'size'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Hiển thị form để tạo sản phẩm mới.
     */
    public function create()
    {
        $categories = Category::all();
        $sizes      = Size::all();
        return view('admin.products.create', compact('categories', 'sizes'));
    }

    /**
     * Lưu sản phẩm mới vào database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|max:255',
            'category_id'    => 'required|exists:categories,id',
            'size_id'        => 'required|exists:sizes,id',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Hiển thị form để chỉnh sửa sản phẩm.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $sizes      = Size::all();
        return view('admin.products.edit', compact('product', 'categories', 'sizes'));
    }

    /**
     * Cập nhật sản phẩm trong database.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => 'required|max:255',
            'category_id'    => 'required|exists:categories,id',
            'size_id'        => 'required|exists:sizes,id',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Cập nhật sản phẩm thành công!');
    }


    /**
     * Xóa sản phẩm khỏi database.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Xóa sản phẩm thành công!');
    }
}
