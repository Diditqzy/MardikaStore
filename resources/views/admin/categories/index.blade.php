<x-app-layout>

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-wide">Kelola Kategori</h1>
            <p class="text-red-100 mt-2 text-base sm:text-lg">Manajemen kategori produk</p>
        </div>
    </div>


    {{-- CONTENT WRAPPER --}}
    <div class="max-w-7xl mx-auto py-10 px-4">

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 mb-4 text-gray-800 px-4 py-2.5 rounded-xl shadow-sm transition text-sm sm:text-base w-fit">

                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        {{-- HEADER + BUTTON --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">
                Daftar Kategori
            </h1>

            <a href="{{ route('admin.categories.create') }}"
                class="flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 transition text-white px-5 py-2.5 rounded-xl shadow-md text-sm sm:text-base">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kategori
            </a>

        </div>
        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl bg-green-100 border border-green-200 text-green-800 text-sm sm:text-base shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE WRAPPER + RESPONSIVE --}}
        <div class="bg-white shadow-md rounded-2xl overflow-hidden ">

            {{-- SCROLL WRAPPER --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[600px]">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="text-left px-6 py-4 font-semibold">Nama</th>
                            <th class="text-left px-6 py-4 font-semibold">Deskripsi</th>
                            <th class="text-center px-6 py-4 font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $cat)
                            <tr class="border-t hover:bg-red-50 transition">

                                {{-- NAME --}}
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $cat->name }}
                                </td>

                                {{-- DESCRIPTION --}}
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $cat->description ?: '-' }}
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-4 flex-wrap">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                            class="text-blue-600 hover:text-blue-800 flex items-center gap-1 transition whitespace-nowrap">

                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M11 4h2m-1 0v16m9-9H3"/>
                                            </svg>

                                            Edit
                                        </a>

                                        {{-- DELETE --}}
                                        <form method="POST"
                                              action="{{ route('admin.categories.destroy', $cat->id) }}"
                                              onsubmit="return confirm('Menghapus kategori tersebut dapat menghapus produk yang ada didalamnya, apakah anda yakin?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="text-red-600 hover:text-red-800 flex items-center gap-1 transition whitespace-nowrap">

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
                            {{-- EMPTY --}}
                            <tr>
                                <td colspan="3" class="text-center py-10 text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none"
                                         stroke="currentColor" stroke-width="1.5"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8 7h8m-8 4h6m5 7H5a2 2 0 01-2-2V7a2 2 0 012-2h3l1-2h6l1 2h3a2 2 0 012 2v9a2 2 0 01-2 2z"/>
                                    </svg>
                                    Belum ada kategori yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</x-app-layout>
