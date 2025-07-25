@php
    use Illuminate\Support\Facades\Auth;

    $cartCount = 0;
    if (Auth::check()) {
        $cart      = Auth::user()->cart()->firstOrCreate();
        $cartCount = $cart->items()->sum('quantity');
    }
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo + Desktop Menu --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                <div class="hidden space-x-8 sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Trang chủ</x-nav-link>
                    <x-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')">Sản phẩm</x-nav-link>
                    @auth
                        <x-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.index')">
                            Giỏ hàng
                            @if($cartCount > 0)
                                <span class="ml-1 inline-block bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endauth
                    <x-nav-link href="{{ route('info') }}" :active="request()->routeIs('info')">Thông tin</x-nav-link>
                    <x-nav-link href="{{ route('recruitment') }}" :active="request()->routeIs('recruitment')">Tuyển dụng</x-nav-link>
                    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Liên hệ</x-nav-link>
                </div>
            </div>

            {{-- User Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white rounded-md hover:text-gray-700">
                                {{ Auth::user()->name }}
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">Quản lý tài khoản</div>
                            @if (Auth::user()->role == 1)
                                <x-dropdown-link href="{{ route('admin.admin') }}">Trang quản lý</x-dropdown-link>
                            @endif
                            <x-dropdown-link href="{{ route('profile.show') }}">Trang cá nhân</x-dropdown-link>
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">Đăng xuất</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Đăng nhập</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-gray-600 hover:text-gray-900">Đăng ký</a>
                    @endif
                @endauth
            </div>

            {{-- Mobile menu button --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu--}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Trang chủ</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')">Sản phẩm</x-responsive-nav-link>
            @auth
                <x-responsive-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.index')">
                    Giỏ hàng
                    @if($cartCount > 0)
                        <span class="ml-1 inline-block bg-red-500 text-white text-xs rounded-full px-2 py-0.5">
                            {{ $cartCount }}
                        </span>
                    @endif
                </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link href="{{ route('info') }}" :active="request()->routeIs('info')">Thông tin</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('recruitment') }}" :active="request()->routeIs('recruitment')">Tuyển dụng</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Liên hệ</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @endif
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    @if (Auth::user()->role == 1)
                        <x-responsive-nav-link href="{{ route('admin.admin') }}" :active="request()->routeIs('admin.admin')">Trang quản lý</x-responsive-nav-link>
                    @endif
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">Trang cá nhân</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">Đăng xuất</x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="pt-2 pb-1 space-y-1">
                    <x-responsive-nav-link href="{{ route('login') }}">Đăng nhập</x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('register') }}">Đăng ký</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
