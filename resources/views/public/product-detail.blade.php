<x-public-layout>

    <div class="max-w-7xl mx-auto p-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- PRODUCT IMAGE -->
            <div class="bg-white rounded shadow p-4 flex items-center justify-center">
                <img 
                    src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/600' }}"
                    class="object-contain max-h-[500px] w-full"
                >
            </div>

            <!-- PRODUCT INFO -->
            <div class="p-4">
                <h1 class="text-3xl font-bold mb-3">{{ $product->name }}</h1>

                <p class="text-2xl text-blue-600 font-extrabold mb-3">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>

                <p class="text-gray-700 mb-2">
                    Stok: <span class="font-semibold">{{ $product->stock }}</span>
                </p>

                <p class="text-gray-700 mb-4">
                    Toko: 
                    <span class="font-semibold text-green-700">
                        {{ $product->store->name }}
                    </span>
                </p>

                <!-- ADD TO CART FORM -->
                <form action="{{ route('cart.store') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- QTY -->
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Jumlah</label>

                        <div class="flex items-center gap-2">

                            <!-- MINUS -->
                            <button type="button"
                                onclick="qtyMinus()"
                                class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded flex items-center justify-center text-xl font-bold">
                                -
                            </button>

                            <!-- INPUT -->
                            <input 
                                type="text"
                                name="quantity"
                                id="qtyInput"
                                value="1"
                                class="w-16 p-2 border rounded text-center"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                onpaste="return false"
                            >

                            <!-- PLUS -->
                            <button type="button"
                                onclick="qtyPlus({{ $product->stock }})"
                                class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded flex items-center justify-center text-xl font-bold">
                                +
                            </button>

                        </div>

                        <p class="text-sm text-gray-500 mt-1">Stok tersedia: {{ $product->stock }}</p>
                    </div>

                    <!-- BUTTON -->
                    @guest
                        <a href="{{ route('login') }}" 
                           class="bg-blue-600 text-white px-6 py-3 rounded block text-center">
                           Login untuk membeli
                        </a>
                    @else
                        <button type="submit" 
                            class="bg-green-600 text-white px-6 py-3 rounded w-full">
                            Tambah ke Keranjang
                        </button>
                    @endguest

                </form>

            </div>

        </div>

        <!-- DESCRIPTION -->
        <div class="mt-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-3">Deskripsi Produk</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $product->description }}
            </p>
        </div>

    </div>


    <!-- JS UNTUK QTY -->
    <script>
        function qtyMinus() {
            let input = document.getElementById('qtyInput');
            let value = parseInt(input.value || "1");

            if (value > 1) {
                input.value = value - 1;
            }
        }

        function qtyPlus(stock) {
            let input = document.getElementById('qtyInput');
            let value = parseInt(input.value || "1");

            if (value < stock) {
                input.value = value + 1;
            }
        }
    </script>

</x-public-layout>
