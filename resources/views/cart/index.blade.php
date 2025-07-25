<x-app-layout>
  <div class="container mx-auto px-4 py-6 sm:py-8">
    <!-- Page Title -->
    <div class="mb-6 sm:mb-8">
      <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Giỏ hàng của bạn</h2>
      <div class="w-16 h-1 bg-indigo-600 mt-2"></div>
    </div>

    <!-- Notification -->
    @if(session('success'))
      <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      </div>
    @endif

    @if($items->isEmpty())
      <!-- Empty Cart -->
      <div class="bg-white rounded-lg shadow-sm p-6 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mt-4">Giỏ hàng của bạn đang trống</h3>
        <p class="text-gray-500 mt-1">Hãy thêm sản phẩm để bắt đầu mua sắm</p>
        <a href="{{ route('products') }}" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition">
          Tiếp tục mua sắm
        </a>
      </div>
    @else
      <!-- Cart Items - Desktop -->
      <div class="hidden sm:block bg-white rounded-lg shadow-sm overflow-hidden mb-6">
        <table class="w-full">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thành tiền</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach($items as $item)
              <tr>
                <!-- Product -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-16 w-16">
                      @if($item->product->image)
                        <img class="h-full w-full object-cover rounded" src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                      @else
                        <div class="h-full w-full bg-gray-100 flex items-center justify-center rounded">
                          <span class="text-xs text-gray-400">No image</span>
                        </div>
                      @endif
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                      <div class="text-sm text-gray-500">Size: {{ $item->product->size->name }}</div>
                    </div>
                  </div>
                </td>
                
                <!-- Price -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ number_format($item->product->price,0,',','.') }} đ
                </td>
                
                <!-- Quantity -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <form action="{{ route('cart.update',$item) }}" method="POST" class="flex items-center">
                    @csrf @method('PUT')
                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                           min="1" max="{{ $item->product->stock_quantity }}"
                           class="w-20 p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="submit" class="ml-2 text-indigo-600 hover:text-indigo-900">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                      </svg>
                    </button>
                  </form>
                </td>
                
                <!-- Total -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ number_format($item->product->price * $item->quantity,0,',','.') }} đ
                </td>
                
                <!-- Remove -->
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <form action="{{ route('cart.remove',$item) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Cart Items - Mobile -->
      <div class="sm:hidden space-y-4 mb-6">
        @foreach($items as $item)
          <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex">
              <!-- Product Image -->
              <div class="flex-shrink-0 h-20 w-20">
                @if($item->product->image)
                  <img class="h-full w-full object-cover rounded" src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                @else
                  <div class="h-full w-full bg-gray-100 flex items-center justify-center rounded">
                    <span class="text-xs text-gray-400">No image</span>
                  </div>
                @endif
              </div>
              
              <!-- Product Info -->
              <div class="ml-4 flex-1">
                <div class="flex justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                    <p class="text-xs text-gray-500">Size: {{ $item->product->size->name }}</p>
                  </div>
                  <form action="{{ route('cart.remove',$item) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </button>
                  </form>
                </div>
                
                <div class="mt-2 flex justify-between items-center">
                  <span class="text-sm font-medium text-gray-900">{{ number_format($item->product->price,0,',','.') }} đ</span>
                  
                  <!-- Quantity Form -->
                  <form action="{{ route('cart.update',$item) }}" method="POST" class="flex items-center">
                    @csrf @method('PUT')
                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                           min="1" max="{{ $item->product->stock_quantity }}"
                           class="w-16 p-1 border rounded text-center">
                    <button type="submit" class="ml-2 text-indigo-600 text-sm">Cập nhật</button>
                  </form>
                </div>
                
                <div class="mt-2 text-right text-sm font-medium">
                  Thành tiền: {{ number_format($item->product->price * $item->quantity,0,',','.') }} đ
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Summary -->
      <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Tóm tắt đơn hàng</h3>
        
        <div class="flex justify-between mb-2">
          <span class="text-gray-600">Tạm tính:</span>
          <span class="text-gray-900">{{ number_format($total,0,',','.') }} đ</span>
        </div>
        
        <div class="flex justify-between mb-2">
          <span class="text-gray-600">Phí vận chuyển:</span>
          <span class="text-gray-900">0 đ</span>
        </div>
        
        <div class="border-t border-gray-200 my-4"></div>
        
        <div class="flex justify-between text-lg font-bold">
          <span>Tổng cộng:</span>
          <span>{{ number_format($total,0,',','.') }} đ</span>
        </div>
        
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
          <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition flex items-center justify-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
              Xóa giỏ hàng
            </button>
          </form>
          
          <form action="{{ route('payment.redirect') }}" method="POST">
          @csrf
          <button type="submit"
                  class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            Thanh toán
          </button>
        </form>
        </div>
        
        <div class="mt-4 text-center">
          <a href="{{ route('products') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center justify-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Tiếp tục mua sắm
          </a>
        </div>
      </div>
    @endif
  </div>
</x-app-layout>