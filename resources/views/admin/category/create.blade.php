<x-layouts.admin>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <h3 class="font-semibold text-lg text-gray-800 mb-6">
                Thêm Danh mục mới
            </h3>

            {{-- Hiển thị lỗi validation --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form thêm mới --}}
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Tên Danh mục</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required autofocus>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('admin.category.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                        Hủy
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Lưu
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layouts.admin>