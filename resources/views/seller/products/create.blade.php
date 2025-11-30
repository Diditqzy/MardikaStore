<x-app-layout title="Tambah Produk">

    {{-- =========================
        HEADER MERAH
    ========================== --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-3xl font-bold tracking-wide flex items-center gap-3">

                {{-- ICON PRODUK --}}
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20 13V6a2 2 0 00-2-2h-3.28a2 2 0 01-1.42-.59L12 2l-1.3 1.41A2 2 0 009.28 4H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                </svg>

                Tambah Produk Baru
            </h1>
        </div>
    </div>



    {{-- =========================
        WRAPPER KONTEN
    ========================== --}}
    <div class="max-w-3xl mx-auto mt-10 mb-20 px-4">

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-6 shadow">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- CARD FORM --}}
        <div class="bg-white shadow-md border rounded-xl p-10">

            {{-- TOMBOL KEMBALI --}}
            <a href="{{ route('seller.products.index') }}"
               class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl shadow mb-6 transition">

                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 19l-7-7 7-7" />
                </svg>

                Kembali
            </a>

            <form action="{{ route('seller.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf

                {{-- CATEGORY --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Kategori
                    </label>

                    <select name="category_id"
                            class="w-full p-3 border border-gray-300 rounded-xl shadow-sm focus:ring-red-400 focus:border-red-400">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- NAME --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7l9-4 9 4v10l-9 4-9-4V7z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7l9 4 9-4" />
                        </svg>

                        Nama Produk
                    </label>

                    <input type="text"
                           name="name"
                           class="w-full p-3 border-gray-300 rounded-xl shadow-sm focus:ring-red-400 focus:border-red-400"
                           required
                           placeholder="Masukkan nama produk">
                </div>

                {{-- PRICE --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m8-4a8 8 0 11-16 0 8 8 0 0116 0z" />
                        </svg>
                        Harga (Rp)
                    </label>

                    <input type="number"
                           name="price"
                           min="1"
                           class="w-full p-3 border-gray-300 rounded-xl shadow-sm focus:ring-red-400 focus:border-red-400"
                           placeholder="contoh: Rp.15000000"
                           required>
                </div>

                {{-- STOCK --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Stok
                    </label>

                    <input type="number"
                           name="stock"
                           min="1"
                           class="w-full p-3 border-gray-300 rounded-xl shadow-sm focus:ring-red-400 focus:border-red-400"
                           placeholder="Stok produk"
                           required>
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 12h8m-8 4h5m2-8h-7m10-6H6a2 2 0 00-2 2v14l4-2 4 2 4-2 4 2V4a2 2 0 00-2-2z"/>
                        </svg>
                        Deskripsi
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="w-full p-3 border-gray-300 rounded-xl shadow-sm focus:ring-red-400 focus:border-red-400"
                              placeholder="Deskripsikan produk anda"></textarea>
                </div>

                {{-- IMAGE --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 5v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2zm3 3l3 3 2-2 4 4 3-3"/>
                        </svg>
                        Foto Produk
                    </label>

                    <input 
                        type="file"
                        name="image"
                        accept=".jpg,.jpeg,.png"
                        class="w-full p-2 border border-gray-300 rounded-xl cursor-pointer">
                </div>

                {{-- BUTTON SAVE --}}
                <div>
                    <button class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white 
                                   px-6 py-3 rounded-lg font-semibold shadow transition w-full">

                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7" />
                        </svg>

                        Simpan Produk
                    </button>
                </div>

            </form>
        </div>

    </div>


    {{-- SCRIPT ANTI KARAKTER NON ANGKA --}}
    <script>
        document.querySelectorAll('input[type="number"]').forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value !== '' && parseInt(this.value) < 1) {
                    this.value = '';
                }
            });
        });
    </script>

</x-app-layout>
