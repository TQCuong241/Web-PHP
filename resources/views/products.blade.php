{{-- resources/views/products.blade.php --}}
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header & Filters Section -->
        <div class="mb-12">
            <div class="mb-6">
                <p class="text-lg text-gray-600 mt-2">Khám phá những sản phẩm tuyệt vời dành riêng cho bạn</p>
            </div>
            
            <form method="GET" action="{{ route('products') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-end">
                    <!-- Size Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kích cỡ</label>
                        <select name="size_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Tất cả size</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}" {{ request('size_id') == $size->id ? 'selected' : '' }}>
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Price Range Filter -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Khoảng giá</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <input type="number" name="price_min" value="{{ request('price_min') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                                       placeholder="Từ (đ)">
                            </div>
                            <div>
                                <input type="number" name="price_max" value="{{ request('price_max') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                                       placeholder="Đến (đ)">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sort -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp</label>
                        <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" {{ request('sort')=='' ? 'selected' : '' }}>Mặc định</option>
                            <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Giá: Thấp đến cao</option>
                            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Giá: Cao đến thấp</option>
                            <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Mới nhất</option>
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Lọc
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 group border border-gray-100">
                        <!-- Product Image + Quick Actions -->
                        <div class="relative overflow-hidden aspect-square">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400 text-sm">Chưa có ảnh</span>
                                </div>
                            @endif

                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/20 space-x-4">
                                {{-- View Detail --}}
                                <a href="{{ route('products.show', $product) }}" 
                                   class="bg-white/90 hover:bg-white text-gray-800 rounded-full p-3 transition-transform transform hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                 c4.478 0 8.268 2.943 9.542 7
                                                 -1.274 4.057-5.064 7-9.542 7
                                                 -4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                {{-- Add to Cart --}}
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                            class="bg-white/90 hover:bg-white text-gray-800 rounded-full p-3 transition-transform transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5
                                                     M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707
                                                     H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0
                                                     11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full whitespace-nowrap">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="text-sm text-gray-500">Size:</span>
                                <span class="text-sm font-medium bg-gray-100 px-2 py-1 rounded">{{ $product->size->name }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-xl font-bold text-gray-900">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </span>
                                <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                                    Chi tiết
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $products->withQueryString()->links() }}
            </div>

        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900">Không tìm thấy sản phẩm phù hợp</h3>
                <p class="mt-2 text-gray-600">Vui lòng điều chỉnh bộ lọc hoặc quay lại sau.</p>
                <div class="mt-6">
                    <a href="{{ route('products') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        Đặt lại bộ lọc
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
