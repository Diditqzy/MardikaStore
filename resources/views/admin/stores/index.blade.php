<x-app-layout>

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-6">

            <h1 class="text-4xl font-extrabold tracking-wide">
                Mengelola Toko
            </h1>

            <p class="text-red-100 text-lg mt-2">
                Kelola seluruh toko penjual di MardikaStore
            </p>

        </div>
    </div>


    {{-- PAGE CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- BACK BUTTON --}}
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300
                  text-gray-800 px-4 py-2 rounded-xl shadow transition mb-6">

            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19l-7-7 7-7"/>
            </svg>

            Kembali
        </a>


        {{-- SUCCESS ALERT --}}
        @if(session('success'))
            <div class="mb-6 mt-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl shadow">
                {{ session('success') }}
            </div>
        @endif


        {{-- TABLE WRAPPER --}}
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">

            <table class="w-full">

                {{-- TABLE HEADER --}}
                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-left">Nama Toko</th>
                        <th class="px-6 py-4 font-semibold text-left">Pemilik</th>
                        <th class="px-6 py-4 font-semibold text-left">Status</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    @forelse($stores as $store)
                        <tr class="border-b hover:bg-red-50 transition">

                            {{-- STORE NAME --}}
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $store->name }}
                            </td>

                            {{-- OWNER --}}
                            <td class="px-6 py-4 text-gray-700">
                                {{ $store->user->name ?? '-' }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-xl text-sm border
                                    {{ $store->user->status === 'approved'
                                        ? 'bg-green-100 text-green-700 border-green-300'
                                        : 'bg-red-100 text-red-700 border-red-300' }}">
                                    {{ ucfirst($store->user->status) }}
                                </span>
                            </td>

                            {{-- DELETE --}}
                            <td class="px-6 py-4 text-center">

                                <form action="{{ route('admin.stores.destroy', $store->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:text-red-800 font-semibold">
                                        Hapus Toko
                                    </button>

                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-500">
                                Belum ada toko yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
