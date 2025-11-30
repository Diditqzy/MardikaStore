<x-app-layout title="Order Berhasil">

    {{-- STRIP MERAH ATAS --}}
    <div class="w-full h-24 bg-red-600"></div>

    {{-- BOX UTAMA --}}
    <div class="max-w-3xl mx-auto -mt-12 bg-white rounded-2xl shadow-lg p-10 mb-20">

        {{-- ICON CHECK --}}
        <div class="flex justify-center mb-6">
            <div class="bg-green-100 border border-green-300 text-green-600 
                        w-24 h-24 rounded-full flex items-center justify-center shadow">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        {{-- TITLE --}}
        <h1 class="text-3xl font-bold text-center mb-3 text-gray-800">
            Pembayaran Berhasil!
        </h1>

        {{-- SUBTITLE --}}
        <p class="text-center text-gray-600 text-lg mb-8">
            Terima kasih, pesanan Anda telah berhasil dibuat.
        </p>

        {{-- ORDER INFO BOX --}}
        <div class="bg-gray-50 border rounded-2xl p-6 shadow-inner mb-8">

            <p class="text-lg mb-2">
                <span class="font-semibold text-gray-800">Nomor Order:</span>
                <span class="text-red-600 font-semibold">#{{ $order->id }}</span>
            </p>

            <p class="text-lg mb-2">
                <span class="font-semibold text-gray-800">Total Pembayaran:</span>
                <span class="text-red-600 font-bold">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </p>

            <p class="text-lg">
                <span class="font-semibold text-gray-800">Status:</span>
                <span class="capitalize text-blue-600 font-semibold">
                    {{ $order->status }}
                </span>
            </p>
        </div>

        {{-- BUTTON GROUP --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            {{-- LIHAT PESANAN --}}
            <a href="{{ route('buyer.orders.show', $order->id) }}"
               class="w-full sm:w-auto text-center bg-blue-600 text-white px-6 py-3 rounded-xl 
                      hover:bg-blue-700 transition font-semibold shadow">
                Lihat Detail Pesanan
            </a>

            {{-- KEMBALI BELANJA --}}
            <a href="{{ route('buyer.dashboard') }}"
               class="w-full sm:w-auto text-center bg-gray-200 text-gray-800 px-6 py-3 rounded-xl 
                      hover:bg-gray-300 transition font-semibold shadow">
                Kembali Belanja
            </a>
        </div>

    </div>

</x-app-layout>
