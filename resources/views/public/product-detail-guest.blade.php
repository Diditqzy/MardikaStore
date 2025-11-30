<x-public-layout :title="$product->name">

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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- LEFT IMAGE --}}
            <div class="bg-white border-2 border-red-600 shadow-gray-300 shadow-lg rounded-2xl p-6 flex items-center justify-center">
                <div class="w-[500px] h-[400px] bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://via.placeholder.com/500x400?text=Tidak+Ada+Gambar" class="w-full h-full object-cover">
                    @endif
                </div>
            </div>

            {{-- RIGHT INFO --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $product->name }}</h1>

                <p class="text-3xl font-extrabold text-red-600 mb-4">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>

                <div class="space-y-4">

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

                    <div class="flex items-center gap-3">
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

                {{-- BUTTON REGISTER --}}
                <a href="{{ route('register') }}"
                   class="block w-full py-4 mt-6 text-center rounded-xl bg-red-600 text-white text-xl font-bold
                          hover:bg-red-700 transition">
                    Daftar untuk membeli
                </a>

            </div>
        </div>

        {{-- DESCRIPTION --}}
        <div class="mt-16 bg-white shadow-md p-8 rounded-2xl">
            <h2 class="text-2xl font-bold mb-4">Deskripsi Produk</h2>
            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
        </div>

        {{-- REVIEWS --}}
   {{-- REVIEWS --}}
        <div class="mt-10 bg-white shadow-md p-8 rounded-2xl">
            <h2 class="text-2xl font-bold mb-4">Ulasan Pembeli</h2>
            @if($product->reviews->count() == 0)
            <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
            @else
                <div class="space-y-4">
                    @foreach ($product->reviews as $review)
                        <div class="p-4 border rounded-xl bg-gray-50">
                            <div class="font-semibold text-gray-800">
                                {{ $review->user->name }}
                            </div>
                            <div class="text-yellow-500">
                                {{ str_repeat('⭐', $review->rating) }}
                            </div>
                            <p class="text-gray-700 mt-2">
                                {{ $review->comment }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</x-public-layout>
