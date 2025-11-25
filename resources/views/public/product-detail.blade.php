<x-public-layout>

    <div class="max-w-7xl mx-auto p-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- IMAGE -->
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

                <!-- CART BUTTON (STEP 10) -->
                <button
                    disabled
                    class="bg-gray-400 text-white px-6 py-3 rounded cursor-not-allowed">
                    Tambah ke Keranjang (Step 10)
                </button>
            </div>

        </div>

        <!-- DESCRIPTION BOX -->
        <div class="mt-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-3">Deskripsi Produk</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $product->description }}
            </p>
        </div>

    </div>

</x-public-layout>
