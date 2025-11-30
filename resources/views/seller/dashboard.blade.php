<x-app-layout title="Dashboard Seller">

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-12 shadow-md">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-3xl font-bold tracking-wide">Selamat Datang</h1>
            <p class="text-red-100 mt-1">
                Selamat {{ auth()->user()->name }} — akun jualan Anda telah disetujui.
            </p>
        </div>
    </div>

    {{-- WRAPPER --}}
    <div class="max-w-6xl mx-auto mt-10 mb-20 px-4">


        {{-- =====================================================
            PERINGATAN JIKA BELUM MEMILIKI TOKO
        ===================================================== --}}
        @if (!$store)
            <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded-xl mb-8 flex items-center gap-3">

                {{-- ICON WARNING --}}
                <svg class="w-7 h-7 text-yellow-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M5.07 19h13.86L12 3 5.07 19z" />
                </svg>

                Anda belum melengkapi informasi toko.
                <a href="{{ route('seller.store') }}"
                    class="ml-auto bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm">
                    Lengkapi Sekarang
                </a>

            </div>
        @endif


        {{-- =====================================================
            MENU UTAMA SELLER
        ===================================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- KELOLA TOKO --}}
            <a href="{{ route('seller.store') }}"
                class="bg-white shadow-md border rounded-xl p-6 flex flex-col items-center hover:shadow-lg transition">

                <svg class="w-14 h-14 text-red-600 mb-4" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 9l1-5h16l1 5M4 9h16v11H4V9zm4 4h4m-4 4h8" />
                </svg>

                <h3 class="text-xl font-bold text-gray-800">Kelola Toko</h3>
                <p class="text-gray-500 text-center mt-1 text-sm">Ubah nama, deskripsi, dan foto toko Anda.</p>
            </a>


            {{-- BUAT PRODUK --}}
            <a href="{{ route('seller.products.create') }}"
                class="bg-white shadow-md border rounded-xl p-6 flex flex-col items-center hover:shadow-lg transition">

                <svg class="w-14 h-14 text-green-600 mb-4" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4v16m8-8H4" />
                </svg>

                <h3 class="text-xl font-bold text-gray-800">Tambah Produk</h3>
                <p class="text-gray-500 text-center mt-1 text-sm">Mulai tambahkan produk untuk dijual.</p>
            </a>


            {{-- LIHAT PRODUK --}}
            <a href="{{ route('seller.products.index') }}"
                class="bg-white shadow-md border rounded-xl p-6 flex flex-col items-center hover:shadow-lg transition">

                <svg class="w-14 h-14 text-blue-600 mb-4" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 7h18M3 12h18M3 17h18" />
                </svg>

                <h3 class="text-xl font-bold text-gray-800">Daftar Produk</h3>
                <p class="text-gray-500 text-center mt-1 text-sm">Lihat dan kelola semua produk toko Anda.</p>
            </a>


            {{-- LIHAT PESANAN --}}
            <a href="{{ route('seller.orders.index') }}"
                class="bg-white shadow-md border rounded-xl p-6 flex flex-col items-center hover:shadow-lg transition">

                <svg class="w-14 h-14 text-purple-600 mb-4" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h4m-2-8a2 2 0 110-4 2 2 0 010 4zm7 0h.01M5 12h.01M5 16h.01M19 16h.01" />
                </svg>

                <h3 class="text-xl font-bold text-gray-800">Pesanan</h3>
                <p class="text-gray-500 text-center mt-1 text-sm">Pantau pesanan yang masuk ke toko Anda.</p>
            </a>

        </div>

    </div>

</x-app-layout>
