<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                {{-- Sidebar --}}
                <aside class="w-full md:w-1/4">
                    <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-gray-800 mb-4">Menu</h3>
                            <nav class="flex flex-col space-y-2">
                                <a href="{{ route('admin.admin') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.admin') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    Tổng quan
                                </a>
                                <a href="{{ route('admin.category.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.category.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    Quản lý Danh mục
                                </a>
                                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.products.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    Quản lý Sản phẩm
                                </a>
                                {{-- Bỏ hoặc comment dòng Posts vì chưa có route --}}
                                {{--
                                <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.posts.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    Quản lý Bài viết
                                </a>
                                --}}
                                <a href="{{ route('admin.sizes.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.sizes.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    Quản lý Size
                                </a>
                                <a href="{{ route('admin.recruitments.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.recruitments.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    Quản lý Tuyển dụng
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    Quản lý Người dùng
                                </a>
                            </nav>
                        </div>
                    </div>
                </aside>

                {{-- Main content --}}
                <main class="w-full md:w-3/4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
