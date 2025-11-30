<x-app-layout title="Pesanan Saya">

    {{-- STRIP MERAH --}}
    <div class="w-full h-24 bg-red-600"></div>

    {{-- WRAPPER UTAMA --}}
    <div class="max-w-5xl mx-auto -mt-12 bg-white shadow-lg rounded-2xl p-8 mb-20">

        {{-- HEADER + BACK BUTTON --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Pesanan Saya
            </h1>

            <a href="{{ route('buyer.dashboard') }}"
               class="bg-gray-200 px-5 py-2 rounded-xl hover:bg-gray-300 transition text-gray-800 font-medium">
                Kembali
            </a>
        </div>

        @if($orders->isEmpty())
            <div class="bg-gray-50 p-10 text-center rounded-2xl shadow">
                <p class="text-xl font-semibold text-gray-700 mb-2">Belum ada pesanan.</p>
                <p class="text-gray-500 mb-6">Pesan produk untuk melihat daftar pesanan Anda.</p>

                <a href="{{ route('buyer.dashboard') }}"
                   class="inline-block bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700 transition shadow">
                    Mulai Belanja
                </a>
            </div>
        @endif

        {{-- LIST PESANAN --}}
        <div class="space-y-5">
            @foreach($orders as $o)
                <div class="bg-gray-50 p-5 rounded-2xl shadow hover:bg-red-50 transition border">

                    <div class="flex justify-between items-start">

                        {{-- LEFT --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                Order #{{ $o->id }}
                            </h3>
                            <p class="text-gray-600 text-sm mt-1">
                                {{ $o->created_at->format('d M Y • H:i') }}
                            </p>
                        </div>

                        {{-- RIGHT --}}
                        <div class="text-right">

                            {{-- TOTAL PRICE --}}
                            <p class="text-red-600 text-xl font-bold mb-1">
                                Rp {{ number_format($o->total_price,0,',','.') }}
                            </p>

                            {{-- STATUS --}}
                            <p class="text-sm font-semibold capitalize
                                @if($o->status === 'pending') text-yellow-600
                                @elseif($o->status === 'cancelled') text-red-600
                                @else text-green-600
                                @endif">
                                {{ $o->status }}
                            </p>

                            {{-- DETAIL LINK --}}
                            <a href="{{ route('buyer.orders.show', $o->id) }}"
                               class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
                                Lihat Detail
                            </a>

                        </div>

                    </div>

                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-8">
            {{ $orders->links() }}
        </div>

    </div>

</x-app-layout>
