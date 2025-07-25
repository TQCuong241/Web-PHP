<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Hiển thị trang danh sách danh mục.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Hiển thị form để tạo danh mục mới.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Lưu danh mục mới vào database.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        // Tạo và lưu danh mục
        Category::create([
            'name' => $request->name,
        ]);

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Cập nhật danh mục trong database.
     */
    public function update(Request $request, Category $category)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        // Cập nhật
        $category->update([
            'name' => $request->name,
        ]);

        // Chuyển hướng về trang danh sách
        return redirect()->route('admin.category.index')->with('success', 'Cập nhật danh mục thành công!');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('admin.category.index')->with('success', 'Xóa danh mục thành công!');
    }

    // Các phương thức khác cho việc sửa, xóa sẽ được thêm vào sau
}