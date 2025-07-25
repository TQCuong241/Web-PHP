{{-- resources/views/products/show.blade.php --}}
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Hiện thông báo flash --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Product Detail Card -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <div class="md:flex">
                <!-- Image Gallery Section -->
                <div class="md:w-1/2 relative">
                    @if($product->image)
                        <div class="aspect-w-1 aspect-h-1 w-full">
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transition duration-300 hover:scale-105 transform">
                        </div>
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                            <span class="text-gray-400">Chưa có ảnh</span>
                        </div>
                    @endif

                    <!-- Image Badges -->
                    <div class="absolute top-4 left-4 flex space-x-2">
                        @if($isNew)
                            <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">MỚI</span>
                        @endif
                        @if($product->discount > 0)
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                -{{ $product->discount }}%
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Product Info Section -->
                <div class="md:w-1/2 p-8">
                    <!-- Breadcrumb -->
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <a href="{{ route('home') }}" class="hover:text-indigo-600">Trang chủ</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ route('products') }}" class="hover:text-indigo-600">Sản phẩm</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-gray-700">{{ $product->category->name }}</span>
                    </div>

                    <!-- Product Title -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->rating))
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c..."/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c..."/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <!-- <span class="text-sm text-gray-500 ml-2">({{ $product->review_count }} đánh giá)</span> -->
                    </div>

                    <!-- Meta Info -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" ...></svg>
                            <span class="text-sm text-gray-600">Danh mục: 
                                <span class="font-medium">{{ $product->category->name }}</span>
                            </span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" ...></svg>
                            <span class="text-sm text-gray-600">Mã SP: 
                                <span class="font-medium">{{ $product->sku }}</span>
                            </span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" ...></svg>
                            <span class="text-sm text-gray-600">Size: 
                                <span class="font-medium">{{ $product->size->name }}</span>
                            </span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" ...></svg>
                            <span class="text-sm text-gray-600">Thương hiệu: 
                                <span class="font-medium">{{ $product->brand ?? 'Khác' }}</span>
                            </span>
                        </div>
                    </div>

                    <!-- Price Section -->
                    <div class="mb-6">
                        @if($product->discount > 0)
                            <div class="flex items-center">
                                <span class="text-3xl font-bold text-red-600 mr-3">
                                    {{ number_format($product->price * (100 - $product->discount)/100,0,',','.') }} đ
                                </span>
                                <span class="text-lg text-gray-500 line-through">
                                    {{ number_format($product->price,0,',','.') }} đ
                                </span>
                                <span class="ml-3 bg-red-100 text-red-800 text-sm font-medium px-2 py-0.5 rounded">
                                    Tiết kiệm {{ number_format($product->price * $product->discount/100,0,',','.') }} đ
                                </span>
                            </div>
                        @else
                            <span class="text-3xl font-bold text-gray-900">
                                {{ number_format($product->price,0,',','.') }} đ
                            </span>
                        @endif
                        <div class="text-sm text-gray-500 mt-1">
                            (Còn {{ $product->stock_quantity }} sản phẩm)
                        </div>
                    </div>

                    <!-- Action: Thêm vào giỏ hàng -->
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-6">
                        @csrf
                        <div class="flex items-center space-x-2 mb-4">
                            <button type="button" onclick="this.nextElementSibling.stepDown()"
                                    class="px-3 py-2 bg-gray-100 rounded-l-lg">-</button>
                            <input type="number" name="quantity" value="1" min="1"
                                   max="{{ $product->stock_quantity }}"
                                   class="w-16 text-center border-t border-b border-gray-300 focus:outline-none">
                            <button type="button" onclick="this.previousElementSibling.stepUp()"
                                    class="px-3 py-2 bg-gray-100 rounded-r-lg">+</button>
                        </div>
                        <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" ...></svg>
                            Thêm vào giỏ hàng
                        </button>
                    </form>

                    <!-- Yêu thích (nếu có) -->
                    <!-- <button class="w-full mb-4 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" ...></svg>
                        Yêu thích
                    </button> -->

                    <!-- Back Link -->
                    <div>
                        <a href="{{ route('products') }}"
                           class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" ...></svg>
                            Quay về danh sách sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 font-serif">Sản phẩm liên quan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                        <a href="{{ route('products.show', $related) }}" class="block">
                            @if($related->image)
                                <img src="{{ asset('storage/'.$related->image) }}"
                                     alt="{{ $related->name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400">Chưa có ảnh</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-4">
                            <a href="{{ route('products.show', $related) }}" class="block">
                                <h3 class="text-lg font-medium text-gray-900 mb-1 hover:text-indigo-600 transition">
                                    {{ $related->name }}
                                </h3>
                            </a>
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span class="mr-2">{{ $related->category->name }}</span>
                                <span>•</span>
                                <span class="ml-2">{{ $related->size->name }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">
                                    {{ number_format($related->price,0,',','.') }} đ
                                </span>
                                <button class="text-indigo-600 hover:text-indigo-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" ...></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
