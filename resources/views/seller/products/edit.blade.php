<x-app-layout title="Edit Produk">

    {{-- =========================
         HEADER MERAH
    ========================== --}}
    <div class="bg-red-600 text-white py-10 shadow">
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-3xl font-bold tracking-wide">Edit Produk</h1>
            <p class="text-red-100">Perbarui informasi produk Anda di sini.</p>
        </div>
    </div>

    {{-- =========================
         WRAPPER
    ========================== --}}
    <div class="max-w-4xl mx-auto mt-10 mb-20 px-4">

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('seller.products.index') }}"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300
                  text-gray-800 px-4 py-2 rounded-xl shadow-md mb-6 transition">

            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- =========================
             CARD FORM
        ========================== --}}
        <div class="bg-white shadow-md rounded-xl p-10 border">

            <form action="{{ route('seller.products.update', $product->id) }}"
                  method="POST" enctype="multipart/form-data"
                  class="space-y-6">

                @csrf

                {{-- CATEGORY --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Kategori
                    </label>

                    <select name="category_id"
                            class="w-full p-3 border border-gray-300 rounded-xl shadow-sm
                                   focus:ring-red-400 focus:border-red-400">

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- NAME --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Nama Produk
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ $product->name }}"
                           class="w-full border-gray-300 rounded-xl p-3 shadow-sm
                                  focus:ring-red-400 focus:border-red-400"
                           required>
                </div>

                {{-- PRICE --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v12m-6-6h12" />
                        </svg>
                        Harga (Rp)
                    </label>

                    <input type="number"
                           name="price"
                           min="1"
                           value="{{ $product->price }}"
                           class="w-full border-gray-300 rounded-xl p-3 shadow-sm
                                  focus:ring-red-400 focus:border-red-400"
                           required>
                </div>

                {{-- STOCK --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Stok
                    </label>

                    <input type="number"
                           name="stock"
                           min="1"
                           value="{{ $product->stock }}"
                           class="w-full border-gray-300 rounded-xl p-3 shadow-sm
                                  focus:ring-red-400 focus:border-red-400"
                           required>
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="block font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 12h8m-8 4h5m2-8h-7m10-6H6a2 2 0 00-2 2v14l4-2 4 2 4-2 4 2V4a2 2 0 00-2-2z" />
                        </svg>
                        Deskripsi Produk
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full border-gray-300 rounded-xl p-3 shadow-sm
                               focus:ring-red-400 focus:border-red-400">{{ $product->description }}</textarea>
                </div>

                {{-- IMAGE CURRENT --}}
                <div>
                    <label class="block font-semibold mb-2">Gambar Saat Ini</label>

                    @if ($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="h-32 mb-4 rounded-xl shadow border object-cover">
                    @else
                        <p class="text-gray-500">Tidak ada gambar.</p>
                    @endif
                </div>

                {{-- IMAGE UPLOAD --}}
                <div>
                    <label class="block font-semibold mb-2 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 5v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2zm3 3l3 3 2-2 4 4 3-3" />
                        </svg>
                        Upload Gambar Baru (jpg, jpeg, png)
                    </label>

                    <input type="file"
                           name="image"
                           accept=".jpg,.jpeg,.png"
                           class="block w-full border-gray-300 rounded-xl p-3 shadow-sm cursor-pointer
                                  focus:ring-red-400 focus:border-red-400">
                </div>

                {{-- SUBMIT --}}
                <div>
                    <button class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white
                                   px-6 py-3 rounded-lg font-semibold shadow transition">

                        <svg class="w-6 h-6 text-white" fill="none"
                             stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7" />
                        </svg>

                        Update Produk
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
