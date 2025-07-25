{{-- resources/views/admin/sizes/index.blade.php --}}
<x-layouts.admin>
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Quản lý Size</h1>
        <p class="text-gray-600 mt-2">Danh sách các size sản phẩm hiện có</p>
      </div>
      <a href="{{ route('admin.sizes.create') }}" 
         class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Thêm Size mới
      </a>
    </div>

    <!-- Success Notification -->
    @if(session('success'))
      <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <div class="flex items-center">
          <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          <span class="text-green-700 font-medium">{{ session('success') }}</span>
        </div>
      </div>
    @endif

    <!-- Desktop Table -->
    <div class="hidden md:block bg-white shadow-sm rounded-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Size</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mô tả</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($sizes as $size)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $size->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $size->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $size->description }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.sizes.edit', $size) }}" 
                       class="text-indigo-600 hover:text-indigo-900 flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                      </svg>
                      Sửa
                    </a>
                    <form action="{{ route('admin.sizes.destroy', $size) }}" method="POST" 
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa size này?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Xóa
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="px-6 py-4 border-t border-gray-200">
        {{ $sizes->links() }}
      </div>
    </div>

    <!-- Mobile List -->
    <div class="md:hidden space-y-4">
      @foreach($sizes as $size)
        <div class="bg-white shadow rounded-lg p-4">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="text-lg font-medium text-gray-900">{{ $size->name }}</h3>
              <p class="text-sm text-gray-500">ID: {{ $size->id }}</p>
              <p class="text-sm text-gray-600 mt-1">{{ $size->description }}</p>
            </div>
            <div class="flex space-x-2">
              <a href="{{ route('admin.sizes.edit', $size) }}" 
                 class="p-2 text-indigo-600 rounded-full hover:bg-indigo-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </a>
              <form action="{{ route('admin.sizes.destroy', $size) }}" method="POST" 
                    onsubmit="return confirm('Bạn chắc chắn muốn xóa size này?')">
                @csrf @method('DELETE')
                <button type="submit" class="p-2 text-red-600 rounded-full hover:bg-red-50">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
      <div class="mt-4">
        {{ $sizes->links() }}
      </div>
    </div>
  </div>
</x-layouts.admin>
