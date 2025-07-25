{{-- File: resources/views/admin/products/edit.blade.php --}}
<x-layouts.admin>
    <div class="bg-white p-6 rounded-lg shadow-xl">
        <h3 class="text-lg font-semibold mb-6">Chỉnh sửa Sản phẩm</h3>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2">Tên sản phẩm</label>
                    <input type="text" name="name" class="w-full p-2 border rounded" value="{{ $product->name }}" required>
                </div>
                <div>
                    <label class="block mb-2">Loại sản phẩm</label>
                    <select name="category_id" class="w-full p-2 border rounded" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2">Giá</label>
                    <input type="number" name="price" class="w-full p-2 border rounded" value="{{ $product->price }}" required>
                </div>
                <div>
                    <label class="block mb-2">Số lượng tồn kho</label>
                    <input type="number" name="stock_quantity" class="w-full p-2 border rounded" value="{{ $product->stock_quantity }}" required>
                </div>
                 <div>
                    <label class="block mb-2">Size</label>
                    <input type="text" name="size" class="w-full p-2 border rounded" value="{{ $product->size }}" required>
                </div>
                <div>
                    <label class="block mb-2">Ảnh sản phẩm mới (để trống nếu không đổi)</label>
                    <input type="file" name="image" class="w-full p-2 border rounded">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-24 w-24 object-cover rounded mt-2">
                    @endif
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2">Mô tả</label>
                    <textarea name="description" rows="4" class="w-full p-2 border rounded">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Hủy</a>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Cập nhật</button>
            </div>
        </form>
    </div>
</x-layouts.admin>