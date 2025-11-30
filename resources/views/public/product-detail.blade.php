<x-app-layout :title="$product->name">

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-start mb-6">
            <a href="{{ url('/') }}"
               class="flex items-center gap-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 
                      text-gray-700 font-medium rounded-xl shadow transition">

                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- WRAPPER --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- ===========================
                LEFT: PRODUCT IMAGE
            ============================ --}}
            <div class="bg-white border-2 border-red-600 shadow-gray-300 shadow-lg rounded-2xl p-6 flex items-center justify-center">
                
                <div class="w-[500px] h-[400px] bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover" />
                    @else
                        <img src="https://via.placeholder.com/500x400?text=Tidak+Ada+Gambar" class="w-full h-full object-cover" />
                    @endif
                </div>

            </div>

            {{-- ===========================
                RIGHT: PRODUCT INFO
            ============================ --}}
            <div>

                {{-- NAME --}}
                <h1 class="text-3xl font-bold text-gray-800 mb-3">
                    {{ $product->name }}
                </h1>

                {{-- PRICE --}}
                <p class="text-3xl font-extrabold text-red-600 mb-4">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>

                {{-- DETAIL INFORMASI --}}
                <div class="space-y-4 mt-6">

                    {{-- STORE --}}
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7l9-4 9 4-9 4-9-4zm0 4l9 4 9-4m-9 4v6" />
                        </svg>
                        <p class="text-gray-700 text-lg">
                            Toko: <span class="font-semibold">{{ $product->store->name }}</span>
                        </p>
                    </div>

                    {{-- STOCK --}}
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3h18v4H3zm2 4v14h14V7" />
                        </svg>
                        <p class="text-gray-700 text-lg">
                            Stok tersedia: <span class="font-semibold">{{ $product->stock }}</span>
                        </p>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <p class="text-gray-700 text-lg">
                            Kategori: <span class="font-semibold">{{ $product->category->name ?? '-' }}</span>
                        </p>
                    </div>

                </div>

                {{-- ===========================
                    CTA AREA
                ============================ --}}

                {{-- ========== UNTUK GUEST ========== --}}
                @guest
                    <a href="{{ route('register') }}"
                       class="block w-full py-4 mt-4 text-center rounded-xl bg-red-600 text-white text-xl font-bold
                              hover:bg-red-700 shadow-lg transition">
                        Daftar untuk membeli
                    </a>
                @endguest


                {{-- ========== UNTUK BUYER ========== --}}
                @auth
                    @if (auth()->user()->role === 'buyer')

                        {{-- FAVORIT BUTTON --}}
                        <form action="{{ route('buyer.wishlist.add', $product->id) }}" method="POST" class="mt-6">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 px-4 py-3 border border-red-600 text-red-600 
                                       rounded-xl hover:bg-red-600 hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 15l7 7 7-7M5 9l7-7 7 7" />
                                </svg>
                                Tambah ke Favorit
                            </button>
                        </form>

                        {{-- ADD TO CART --}}
                        <form action="{{ route('cart.store') }}" method="POST" class="mt-8">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- QTY --}}
                            <div class="flex items-center gap-4 mb-4">

                                <button type="button"
                                        onclick="qtyStep(-1)"
                                        class="w-10 h-10 flex items-center justify-center bg-gray-200 rounded-lg text-xl">
                                    -
                                </button>

                                <input id="qtyInput"
                                       type="number"
                                       name="quantity"
                                       min="1"
                                       value="1"
                                       class="w-16 text-center border rounded-lg py-2">

                                <button type="button"
                                        onclick="qtyStep(1)"
                                        class="w-10 h-10 flex items-center justify-center bg-gray-200 rounded-lg text-xl">
                                    +
                                </button>

                            </div>

                            {{-- BUTTON CART --}}
                            <button type="submit"
                                    class="w-full py-4 bg-red-600 text-white text-xl font-bold rounded-xl 
                                           hover:bg-red-700 transition shadow-lg">
                                Tambah ke Keranjang
                            </button>
                        </form>

                        {{-- ALERT --}}
                        @if(session('success'))
                            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- QTY JS --}}
                        <script>
                            function qtyStep(step) {
                                const input = document.getElementById('qtyInput');
                                let value = parseInt(input.value) + step;
                                if (value < 1) value = 1;
                                input.value = value;
                            }
                        </script>

                    @endif
                @endauth


            </div>

        </div> {{-- END GRID --}}

        {{-- DESCRIPTION --}}
        <div class="mt-16 bg-white shadow-md p-8 rounded-2xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Produk</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $product->description }}
            </p>
        </div>

        {{-- REVIEWS --}}
        <div class="mt-10 bg-white shadow-md p-8 rounded-2xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ulasan Pembeli</h2>

            <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
        </div>

    </div>

</x-app-layout>
