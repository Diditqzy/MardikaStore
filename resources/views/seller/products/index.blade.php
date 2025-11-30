<x-app-layout title="Produk Saya">

    {{-- STRIP MERAH HEADER --}}
    <div class="bg-red-600 text-white py-10 shadow">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-3xl font-bold tracking-wide">Daftar Produk Anda</h1>
            <p class="text-red-100">Kelola semua produk yang telah Anda buat.</p>
        </div>
    </div>

    {{-- WRAPPER --}}
    <div class="max-w-6xl mx-auto px-4 mt-10 mb-20">

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('seller.dashboard') }}"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 
                  text-gray-800 px-4 py-2 rounded-xl shadow-md mb-6 transition">

            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19l-7-7 7-7" />
            </svg>

            Kembali
        </a>

        {{-- BUTTON ADD PRODUCT --}}
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Produk Anda</h2>

            <a href="{{ route('seller.products.create') }}"
               class="flex items-center gap-2 bg-green-600 hover:bg-green-700
                      text-white px-5 py-2.5 rounded-xl shadow transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>

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

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 p-4 rounded-xl shadow flex items-center gap-3">
                <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden border">
            <table class="w-full">
                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Gambar</th>
                        <th class="px-6 py-3 text-left">Nama Produk</th>
                        <th class="px-6 py-3 text-left">Harga</th>
                        <th class="px-6 py-3 text-left">Stok</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $p)
                        <tr class="border-b hover:bg-red-50 transition">

                            <td class="px-6 py-4">
                                @if($p->image)
                                    <img src="{{ asset('storage/'.$p->image) }}"
                                         class="h-16 w-16 object-cover rounded shadow">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $p->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                Rp.{{ number_format($p->price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $p->stock }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-4">

                                    {{-- EDIT --}}
                                    <a href="{{ route('seller.products.edit', $p->id) }}"
                                       class="text-blue-600 hover:text-blue-800 flex items-center gap-1">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M11 4h2m-1 0v16m9-9H3" />
                                        </svg>
                                        Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('seller.products.delete', $p->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:text-red-800 flex items-center gap-1">

                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 6h12M9 6V4h6v2m1 0v12a2 2 0 01-2 2H9a2 2 0 01-2-2V6z"/>
                                            </svg>

                                            Hapus
                                        </button>

                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500">
                                Belum ada produk yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</x-app-layout>
