<x-app-layout title="Pesanan Masuk">

    {{-- ============================
            HEADER MERAH
    ============================= --}}
    <div class="bg-red-600 text-white py-10 shadow">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-3xl font-bold tracking-wide flex items-center gap-3">

                {{-- ICON ORDER --}}
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h18M3 7h18M8 11h8m-8 4h5m-5 4h8" />
                </svg>

                Pesanan Masuk
            </h1>
            <p class="text-red-100 mt-1">
                Daftar semua pesanan yang masuk ke toko Anda.
            </p>
        </div>
    </div>

    {{-- ============================
            WRAPPER KONTEN
    ============================= --}}
    <div class="max-w-6xl mx-auto mt-10 mb-20 px-4">

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('seller.dashboard') }}"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300
                  text-gray-800 px-4 py-2 rounded-xl shadow-md mb-6 transition">

            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19l-7-7 7-7" />
            </svg>

            Kembali
        </a>

        {{-- ============================
                DAFTAR ORDER
        ============================= --}}
        @forelse ($orders as $o)

            <div class="bg-white p-6 rounded-xl shadow border hover:border-red-400 transition mb-5">

                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">

                    {{-- LEFT SECTION --}}
                    <div>
                        <h3 class="font-bold text-xl flex items-center gap-2">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 7h18M3 12h18M8 17h8" />
                            </svg>
                            Order #{{ $o->id }}
                        </h3>

                        <p class="text-gray-600 text-sm mt-1">
                            Buyer: <span class="font-semibold">{{ $o->buyer->name }}</span>
                        </p>

                        <p class="text-gray-600 text-sm">
                            Tanggal: {{ $o->created_at->format('d M Y') }}
                        </p>
                    </div>

                    {{-- RIGHT SECTION --}}
                    <div class="text-right">

                        {{-- TOTAL PRICE --}}
                        <p class="text-lg font-bold text-gray-800">
                            Rp {{ number_format($o->total_price, 0, ',', '.') }}
                        </p>

                        {{-- STATUS BADGE --}}
                        <span class="px-3 py-1 rounded-full text-sm
                            @if($o->status === 'pending') bg-yellow-100 text-yellow-700 
                            @elseif($o->status === 'paid') bg-blue-100 text-blue-700
                            @elseif($o->status === 'shipped') bg-purple-100 text-purple-700
                            @elseif($o->status === 'completed') bg-green-100 text-green-700
                            @else bg-gray-200 text-gray-600 @endif">
                            {{ ucfirst($o->status) }}
                        </span>

                        <div class="mt-3">
                            <a href="{{ route('seller.orders.show', $o->id) }}"
                                class="text-red-600 font-semibold hover:underline">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="bg-white p-10 rounded-xl shadow border text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7h8m-4 4h4m-8 0h2m-6 8h16a2 2 0 002-2V7a2 2 0 00-2-2h-3l-1-2H8L7 5H4a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>

                <p class="text-gray-500">Belum ada pesanan masuk.</p>
            </div>

        @endforelse

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $orders->links() }}
        </div>

    </div>

</x-app-layout>
