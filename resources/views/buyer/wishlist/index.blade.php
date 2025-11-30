<x-app-layout title="Wishlist">

    {{-- STRIP MERAH ATAS --}}
    <div class="w-full h-24 bg-red-600"></div>

    {{-- WRAPPER PUTIH UTAMA --}}
    <div class="max-w-7xl mx-auto -mt-12 bg-white rounded-2xl shadow p-6 mb-12">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Produk Favorit</h1>

            <a href="{{ route('buyer.dashboard') }}"
               class="bg-red-600 text-white px-5 py-2 rounded-xl hover:bg-red-700 transition">
                Kembali
            </a>
        </div>

        <hr class="my-4">

        {{-- KOSONG --}}
        @if ($wishlists->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow">

                <p class="text-xl font-semibold text-gray-700 mb-2">
                    Belum ada produk favorit.
                </p>

                <p class="text-gray-500 mb-6">
                    Klik ikon hati pada produk untuk menambahkannya ke wishlist.
                </p>

                <a href="{{ route('buyer.dashboard') }}"
                   class="inline-block bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700 transition">
                    Kembali ke Beranda
                </a>

            </div>
        @else

            {{-- GRID PRODUK --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">

                @foreach ($wishlists as $item)
                    @php $p = $item->product; @endphp

                    <div class="bg-white shadow-md rounded-2xl overflow-hidden 
                                hover:-translate-y-1 hover:shadow-xl hover:bg-red-50 duration-300">

                        {{-- GAMBAR --}}
                        <div class="w-full h-52 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('storage/' . $p->image) }}" class="h-full object-contain">
                        </div>

                        {{-- INFO --}}
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1">{{ $p->name }}</h3>

                            <p class="text-red-600 font-bold text-xl mb-1">
                                Rp {{ number_format($p->price,0,',','.') }}
                            </p>

                            <p class="text-gray-500 text-sm mb-3">{{ $p->store->name ?? 'Toko' }}</p>

                            {{-- BUTTON HAPUS --}}
                            <form action="{{ route('buyer.wishlist.remove', $p->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="w-full bg-red-600 text-white py-2 rounded-xl hover:bg-red-700 transition">
                                    Hapus dari Favorit
                                </button>
                            </form>

                        </div>

                    </div>
                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>
