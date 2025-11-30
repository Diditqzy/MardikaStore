<x-app-layout title="Buyer Dashboard">

    <div class="w-full bg-gray-100 pb-16">

        {{-- SEARCH + FILTER WRAPPER --}}
        <div class="bg-gray-50 p-6 rounded-2xl shadow-sm mb-10">

        <form method="GET" class="flex flex-col md:flex-row gap-4 items-stretch">

            {{-- SEARCH BAR --}}
            <div class="flex items-center bg-white rounded-xl px-4 h-16 flex-1 shadow-sm
                        transition border-2 border-transparent focus-within:border-red-600">

                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-7 h-7 text-red-600"
                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>

                <input type="text" 
                    name="search" 
                    placeholder="Cari produk..."
                    value="{{ request('search') }}"
                    class="w-full bg-transparent border-0 outline-none ring-0 focus:ring-0 focus:border-0 ml-3 text-lg">
            </div>


            {{-- KATEGORI --}}
            <div 
                x-data="{
                    open: false, 
                    label: '{{ request()->category_id ? \App\Models\Category::find(request()->category_id)->name : 'Semua Kategori' }}'
                }"
                class="relative w-full md:w-64">

                <button type="button"
                    @click="open = !open"
                    class="w-full h-16 flex items-center bg-white rounded-xl px-4 shadow-sm gap-3
                           border-2 border-transparent transition focus:border-red-600">

                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <span class="flex-1 text-left text-lg" x-text="label"></span>

                    <svg class="w-7 h-7 text-gray-600 transition-transform duration-200"
                        :class="open ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div  x-show="open"
                      @click.outside="open=false"
                      x-transition
                      class="absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-lg border z-50 overflow-hidden">

                    <div class="px-4 py-3 cursor-pointer hover:bg-red-50 hover:text-red-600"
                         @click="label='Semua Kategori'; $refs.cat.value=''; open=false">
                        Semua Kategori
                    </div>

                    @foreach ($categories as $cat)
                        <div class="px-4 py-3 cursor-pointer hover:bg-red-50 hover:text-red-600"
                             @click="label='{{ $cat->name }}'; $refs.cat.value='{{ $cat->id }}'; open=false">
                             {{ $cat->name }}
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="category_id" x-ref="cat" value="{{ request()->category_id }}">
            </div>


            {{-- WISHLIST --}}
            <a href="{{ route('buyer.wishlist') }}"
               class="h-16 w-16 flex items-center justify-center bg-white rounded-xl shadow-sm
                      hover:bg-red-50 border border-gray-200 transition">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21l-7.682-8.318a4.5 4.5 0 010-6.364z"/>
                </svg>
            </a>

            {{-- CART --}}
            <a href="{{ route('cart.index') }}"
               class="h-16 w-16 flex items-center justify-center bg-white rounded-xl shadow-sm
                      hover:bg-red-50 border border-gray-200 transition">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8H20m-13-8V6h13" />
                </svg>
            </a>

            {{-- FILTER --}}
            <button class="bg-red-600 text-white px-7 h-16 rounded-xl hover:bg-red-700 transition text-lg shadow-md">
                Filter
            </button>

            {{-- HISTORY / RIWAYAT PESANAN --}}
            <a href="{{ route('buyer.orders.index') }}"
               class="bg-blue-600 text-white px-7 h-16 rounded-xl flex items-center justify-center
                      hover:bg-blue-700 transition text-lg shadow-md">
                Riwayat Pesanan
            </a>

        </form>
        </div>



        {{-- KOSONG --}}
        @if ($products->isEmpty())
            <div class="text-center py-20">
                @if(request()->category_id)
                    @if($categoryHasAnyProducts)
                        <p class="text-xl font-semibold text-gray-700 mb-2">Produk yang Anda cari tidak ada.</p>
                        <p class="text-gray-500">Coba keyword lain.</p>
                    @else
                        <p class="text-xl font-semibold text-gray-700 mb-2">Kategori ini belum memiliki produk.</p>
                        <p class="text-gray-500">Silakan pilih kategori lain.</p>
                    @endif
                @elseif(request()->search)
                    <p class="text-xl font-semibold text-gray-700 mb-2">Produk tidak ditemukan.</p>
                @else
                    <p class="text-xl font-semibold text-gray-700 mb-2">Belum ada produk tersedia.</p>
                @endif
            </div>
        @endif



        {{-- PRODUCT GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
            @foreach ($products as $p)
                <div class="bg-white shadow-md rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-xl hover:bg-red-50 duration-300 transition">

                    {{-- IMAGE --}}
                    <div class="w-full h-52 bg-gray-100 flex items-center justify-center overflow-hidden">
                        <img src="{{ $p->image ? asset('storage/'.$p->image) : 'https://via.placeholder.com/300' }}"
                             class="h-full object-contain">
                    </div>

                    {{-- INFO --}}
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">{{ $p->name }}</h3>
                        <p class="text-red-600 font-bold text-xl mb-1">Rp {{ number_format($p->price,0,',','.') }}</p>
                        <p class="text-sm text-gray-500 mb-2">{{ $p->store->name ?? 'Toko' }}</p>

                        <p class="inline-block px-3 py-1.5 bg-yellow-500 text-white text-xs font-semibold rounded-lg mb-4">
                            {{ $p->category->name ?? 'Tanpa Kategori' }}
                        </p>

                        <a href="{{ route('product.detail', $p->id) }}"
                           class="block w-full text-center bg-red-600 text-white py-2 rounded-xl hover:bg-red-700 transition">
                            Lihat Detail
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>

</x-app-layout>
