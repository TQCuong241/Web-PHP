{{-- resources/views/admin/sizes/edit.blade.php --}}
<x-layouts.admin>
  <div class="bg-white p-6 rounded-lg shadow-xl">
    <h3 class="text-lg font-semibold mb-4">Chỉnh sửa Size</h3>

        <form action="{{ route('admin.sizes.update', $size) }}" method="POST">
        @csrf @method('PUT')
        <!-- Tên size -->
        <label class="block mb-2">Tên Size</label>
        <input type="text" name="name" value="{{ old('name', $size->name) }}"
                class="w-full p-2 border rounded" required>
        @error('name') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Mô tả size -->
        <label class="block mt-4 mb-2">Mô tả (tùy chọn)</label>
        <textarea name="description" rows="3"
                    class="w-full p-2 border rounded">{{ old('description', $size->description) }}</textarea>
        @error('description') <p class="text-red-500">{{ $message }}</p> @enderror

        <!-- Buttons -->
        <div class="mt-4 flex items-center">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Cập nhật</button>
            <a href="{{ route('admin.sizes.index') }}" class="ml-4 text-gray-600 hover:underline">Hủy</a>
        </div>
        </form>

  </div>
</x-layouts.admin>
