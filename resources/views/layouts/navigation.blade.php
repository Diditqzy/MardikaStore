@php
    $dashboardUrl = match(auth()->user()->role ?? null) {
        'admin' => route('admin.dashboard'),
        'seller' => route('seller.dashboard'),
        'buyer' => route('buyer.dashboard'),
        default => '/',
    };
@endphp

<nav class="bg-white shadow-md border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-20">

            {{-- LEFT: BRAND --}}
            <div class="flex items-center gap-3">
                <div class="bg-red-600 p-2 rounded-xl">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="16" cy="20" r="1" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 4h2l3 12h10l3-8H6" />
                    </svg>
                </div>

                <a href="/" class="text-2xl tracking-wide font-extrabold text-gray-800">
                    Mardika<span class="text-red-600">Store</span>
                </a>
            </div>


            {{-- RIGHT: USER MENU --}}
            <div class="flex items-center gap-6">

                {{-- NOTIFICATION ICON (Optional future use) --}}



                {{-- USER DROPDOWN --}}
                <div x-data="{ open: false }" class="relative">

                    {{-- BUTTON --}}
                    <button @click="open = !open"
                        class="flex items-center gap-3 hover:bg-gray-100 px-4 py-2 rounded-xl transition">

                        <div class="w-10 h-10 bg-red-100 border border-red-300 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7l4 4 5-7 5 7 4-4v11H3V7z" />
                        </svg>
                        </div>

                        <span class="font-semibold text-gray-800 hidden sm:block">
                            {{ Auth::user()->name }}
                        </span>

                        <svg class="w-5 h-5 text-gray-600 transform"
                            :class="open ? 'rotate-180' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>


                    {{-- DROPDOWN MENU --}}
                    <div x-show="open" @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-3 w-52 bg-white shadow-lg border rounded-xl overflow-hidden z-50">

                        <div class="px-4 py-3 border-b">
                            <p class="text-sm text-gray-500">Masuk sebagai</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="w-full text-left flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-gray-700 hover:text-red-600 transition">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4H8a2 2 0 00-2 2v12a2 2 0 002 2h4m4-8H9m7-4l3 4-3 4" />
                                </svg>
                                Logout
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</nav>
