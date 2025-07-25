<x-layouts.admin>
    {{-- Hiển thị thông báo thành công (nếu có) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-semibold text-lg text-gray-800">
                    Quản lý Danh mục Sản phẩm
                </h3>
                {{-- Nút Thêm mới --}}
                <a href="{{ route('admin.category.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Thêm Danh mục
                </a>
            </div>

            {{-- Bảng hiển thị danh sách danh mục --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm text-left">ID</th>
                            <th class="w-8/12 py-3 px-4 uppercase font-semibold text-sm text-left">Tên Danh mục</th>
                            <th class="w-3/12 py-3 px-4 uppercase font-semibold text-sm text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($categories as $category)
                            <tr class="border-b">
                                <td class="py-3 px-4">{{ $category->id }}</td>
                                <td class="py-3 px-4">{{ $category->name }}</td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('admin.category.edit', $category) }}" class="text-yellow-500 hover:text-yellow-700 font-bold">Sửa</a>
                                    <form action="{{ route('admin.category.destroy', $category) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-gray-500">Chưa có danh mục nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>