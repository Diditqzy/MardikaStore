<x-app-layout>

    {{-- HEADER --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold tracking-wide">Daftar Penjual</h1>
            <p class="text-red-100 mt-2 text-lg">Lihat semua seller yang sudah disetujui</p>
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

        {{-- TABEL --}}
        <div class="bg-white shadow-md rounded-2xl overflow-hidden mt-8">

            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px]">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Nama</th>
                            <th class="px-6 py-4 text-left font-semibold">Email</th>
                            <th class="px-6 py-4 text-left font-semibold">Toko</th>
                            <th class="px-6 py-4 text-left font-semibold">Peran</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sellers as $seller)
                            <tr class="border-t hover:bg-red-50 transition">

                                <td class="px-6 py-4 font-medium">{{ $seller->name }}</td>

                                <td class="px-6 py-4">{{ $seller->email }}</td>

                                <td class="px-6 py-4">
                                    {{ $seller->store->store_name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 capitalize">{{ $seller->role }}</td>

                                <td class="px-6 py-4 capitalize">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 
                                                 rounded-xl font-semibold border border-green-200">
                                        {{ $seller->status }}
                                    </span>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-500">
                                    Tidak ada seller yang sudah disetujui.
                                </td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</x-app-layout>
