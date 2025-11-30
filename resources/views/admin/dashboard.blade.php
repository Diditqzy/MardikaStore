<x-app-layout>

    <!-- HEADER MERAH -->
    <div class="bg-red-600 text-white py-12 shadow-md">
        <div class="max-w-7xl mx-auto text-center px-4">

            <!-- TITLE -->
            <h1 class="text-4xl font-extrabold tracking-wide">
                Admin Mardika
            </h1>

            <!-- DESCRIPTION -->
            <p class="text-red-100 text-lg mt-3">
                Kelola seluruh data dan aktivitas di MardikaStore
            </p>

        </div>
    </div>


    <!-- CONTENT SECTION -->
    <div class="max-w-7xl mx-auto py-12 px-4">

        <!-- GRID MENU -->
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mx-auto max-w-6xl place-items-center ">

            {{-- CARD STYLE GLOBAL --}}
            @phpz
                $cardClass = "bg-white p-7 w-full max-w-sm rounded-2xl shadow-md border border-gray-100
                            hover:shadow-2xl hover:-translate-y-2 hover:border-red-300 
                            transition-all duration-300 cursor-pointer";
                $iconClass = "w-14 h-14 text-red-600";
                $titleClass = "text-xl font-bold text-gray-800";
                $descClass = "text-gray-500 text-sm mt-1";
            @endphp
            @php
    $cardClass = "block bg-white shadow-md hover:shadow-lg rounded-xl p-6 border hover:border-red-500 transition";
    $iconClass = "w-10 h-10 text-red-600";
    $titleClass = "text-xl font-bold text-gray-800";
    $descClass = "text-gray-500 text-sm mt-1";
@endphp

            {{-- KATEGORI --}}
            <a href="/admin/categories" class="{{ $cardClass }}">
                <div class="flex items-center gap-4">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <div>
                        <h2 class="{{ $titleClass }}">Kategori</h2>
                        <p class="{{ $descClass }}">Kelola kategori produk</p>
                    </div>
                </div>
            </a>

            {{-- PRODUK --}}
            <a href="/admin/products" class="{{ $cardClass }}">
                <div class="flex items-center gap-4">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v4H3zM5 7v14h14V7"/>
                    </svg>
                    <div>
                        <h2 class="{{ $titleClass }}">Produk</h2>
                        <p class="{{ $descClass }}">Kelola semua produk penjual</p>
                    </div>
                </div>
            </a>

            {{-- SELLER PENDING --}}
            <a href="/admin/sellers/pending" class="{{ $cardClass }}">
                <div class="flex items-center gap-4">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4 0-8 2-8 5v3h16v-3c0-3-4-5-8-5z"/>
                    </svg>
                    <div>
                        <h2 class="{{ $titleClass }}">Seller Pending</h2>
                        <p class="{{ $descClass }}">Verifikasi pendaftaran penjual</p>
                    </div>
                </div>
            </a>

            {{-- DAFTAR PENJUAL --}}
           <a href="{{ route('admin.sellers.index') }}" class="{{ $cardClass }}">
                <div class="flex items-center gap-4">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 11V7a4 4 0 10-8 0v4M5 20h14v-8H5v8z"/>
                    </svg>
                    <div>
                        <h2 class="{{ $titleClass }}">Daftar Penjual</h2>
                        <p class="{{ $descClass }}">Lihat semua penjual terdaftar</p>
                    </div>
                </div>
            </a>

            {{-- USER PEMBELI --}}
            <a href="/admin/users" class="{{ $cardClass }}">
                <div class="flex items-center gap-4">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 8c0-4 3-6 7-6s7 2 7 6v1H5v-1z"/>
                    </svg>
                    <div>
                        <h2 class="{{ $titleClass }}">Manajemen pengguna</h2>
                        <p class="{{ $descClass }}">Kelola akun pengguna</p>
                    </div>
                </div>
            </a>
            {{-- TOKO PENJUAL --}}
            <a href="/admin/stores" class="{{ $cardClass }}">
                <div class="flex items-center gap-4">
                    
                    {{-- ICON TOKO --}}
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 9l1-5h16l1 5M4 9h16v11H4V9zm4 4h4m-4 4h8" />
                    </svg>

                    <div>
                        <h2 class="{{ $titleClass }}">Toko Penjual</h2>
                        <p class="{{ $descClass }}">Kelola seluruh toko penjual</p>
                    </div>

                </div>
            </a>

        </div>
    </div>

</x-app-layout>
