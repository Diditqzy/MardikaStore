<x-app-layout>

    {{-- HEADER --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold tracking-wide">Kelola Semua Produk</h1>
            <p class="text-red-100 mt-2 text-lg">Lihat semua produk yang dibuat oleh seller</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-10 px-4">

        {{-- BACK --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 
                  text-gray-800 px-4 py-2 rounded-xl shadow-sm w-fit">

            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        @if(session('success'))
            <div class="mb-6 mt-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white shadow-md rounded-2xl overflow-hidden mt-8">

            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nama Produk</th>
                            <th class="px-6 py-4 font-semibold">Penjual</th>
                            <th class="px-6 py-4 font-semibold">Kategori</th>
                            <th class="px-6 py-4 font-semibold">Harga</th>
                            <th class="px-6 py-4 font-semibold">Stok</th>
                            <th class="px-6 py-4 font-semibold ">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $p)
                            <tr class="border-t hover:bg-red-50 transition">

                                <td class="px-6 py-4 font-semibold">{{ $p->name }}</td>

                                <td class="px-6 py-4">
                                    {{ $p->store->user->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $p->category->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $p->stock }}
                                </td>

                                <td class="px-6 py-4 text-center">

                                    <form action="{{ route('admin.products.destroy', $p->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:text-red-800 font-semibold">
                                            Hapus Produk
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-500">
                                    Tidak ada produk yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</x-app-layout>
