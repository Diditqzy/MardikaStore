<x-app-layout>

    {{-- HEADER MERAH --}}
    <div class="bg-red-600 text-white py-10 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-wide">       
                Mengelola penjual baru
            </h1>
            <p class="text-red-100 mt-2 text-base sm:text-lg">
                Konfirmasi pendaftaran penjual baru sebelum mereka dapat berjualan
            </p>
        </div>
    </div>


    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto py-10 px-4">

        {{-- BACK BUTTON --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 
                  text-gray-800 px-4 py-2 rounded-xl shadow-sm transition 
                  text-sm sm:text-base w-fit">

                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"/>
                </svg>
            Kembali
        </a>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mt-6 mb-6 px-4 py-3 rounded-xl bg-green-100 border border-green-200 
                        text-green-800 text-sm sm:text-base shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="mt-6 mb-6 px-4 py-3 rounded-xl bg-red-100 border border-red-200 
                        text-red-800 text-sm sm:text-base shadow-sm">
                {{ session('error') }}
            </div>
        @endif


        {{-- TABLE WRAPPER --}}
        <div class="bg-white shadow-md rounded-2xl overflow-hidden mt-8">

            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px]">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Nama</th>
                            <th class="px-6 py-4 text-left font-semibold">Email</th>
                            <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($sellers as $seller)
                        <tr class="border-t hover:bg-red-50 transition">

                            {{-- NAME --}}
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $seller->name }}
                            </td>

                            {{-- EMAIL --}}
                            <td class="px-6 py-4 text-gray-700">
                                {{ $seller->email }}
                            </td>

                            {{-- ACTION --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-3 flex-wrap">

                                    {{-- APPROVE --}}
                                    <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="bg-green-600 hover:bg-green-700 text-white 
                                                   px-4 py-2 rounded-xl text-sm shadow-sm transition">
                                            Approved
                                        </button>
                                    </form>

                                    {{-- REJECT --}}
                                    <form action="{{ route('admin.sellers.reject', $seller->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menolak penjual ini?')">
                                        @csrf
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white 
                                                   px-4 py-2 rounded-xl text-sm shadow-sm transition">
                                            Rejected
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-500">

                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3"
                                     fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8 7h8m-8 4h6m5 7H5a2 2 0 01-2-2V7a2 2 0 012-2h3l1-2h6l1 2h3a2 2 0 012 2v9a2 2 0 01-2 2z"/>
                                </svg>

                                Tidak ada seller pending.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</x-app-layout>
