<x-layouts.admin>
    <div class="bg-white p-6 rounded-lg shadow-xl">
        <h3 class="text-lg font-semibold mb-6">Thêm Sản phẩm mới</h3>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Tên sản phẩm --}}
                <div>
                    <label class="block mb-2">Tên sản phẩm</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded" required>
                    @error('name')<small class="text-red-500">{{ $message }}</small>@enderror
                </div>

                {{-- Loại sản phẩm --}}
                <div>
                    <label class="block mb-2">Loại sản phẩm</label>
                    <select name="category_id" class="w-full p-2 border rounded" required>
                        <option value="">-- Chọn loại --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<small class="text-red-500">{{ $message }}</small>@enderror
                </div>

                {{-- Size sản phẩm --}}
                <div>
                    <label class="block mb-2">Size</label>
                    <select name="size_id" class="w-full p-2 border rounded" required>
                        <option value="">-- Chọn size --</option>
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('size_id')<small class="text-red-500">{{ $message }}</small>@enderror
                </div>

                {{-- Giá --}}
                <div>
                    <label class="block mb-2">Giá</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full p-2 border rounded" required>
                    @error('price')<small class="text-red-500">{{ $message }}</small>@enderror
                </div>

                {{-- Số lượng --}}
                <div>
                    <label class="block mb-2">Số lượng tồn kho</label>
                    <input type="number" name="stock_quantity" value="{{ old('stock_quantity') }}" class="w-full p-2 border rounded" required>
                    @error('stock_quantity')<small class="text-red-500">{{ $message }}</small>@enderror
                </div>

                {{-- Ảnh sản phẩm --}}
                <div>
                    <label class="block mb-2">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="w-full p-2 border rounded">
                    @error('image')<small class="text-red-500">{{ $message }}</small>@enderror
                </div>

                {{-- Mô tả --}}
                <div class="md:col-span-2">
                    <label class="block mb-2">Mô tả</label>
                    <textarea name="description" rows="4" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
                    @error('description')<small class="text-red-500">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Hủy</a>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Lưu</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
ư