<x-app-layout title="Detail Pesanan">

    {{-- ================================
            HEADER MERAH
    ================================= --}}
    <div class="bg-red-600 text-white py-10 shadow">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-3xl font-bold tracking-wide flex items-center gap-3">

                {{-- ICON DETAIL --}}
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 7h18M3 12h18M8 17h8" />
                </svg>

                Detail Pesanan #{{ $order->id }}
            </h1>
            <p class="text-red-100 mt-1">
                Informasi lengkap mengenai pesanan ini.
            </p>
        </div>
    </div>


    {{-- ================================
            WRAPPER & TOMBOL KEMBALI
    ================================= --}}
    <div class="max-w-4xl mx-auto mt-10 mb-20 px-4">

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('seller.orders.index') }}"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300
                  text-gray-800 px-4 py-2 rounded-xl shadow-md mb-6 transition">

            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19l-7-7 7-7" />
            </svg>

            Kembali
        </a>


        {{-- ================================
                CARD DETAIL ORDER
        ================================= --}}
        <div class="bg-white shadow-md rounded-xl p-8 border">

            {{-- STATUS --}}
            <div class="mb-6">
                <p class="text-lg font-bold">Status Pesanan:</p>

                <span class="px-4 py-2 rounded-full font-semibold
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                    @elseif($order->status === 'packed') bg-blue-100 text-blue-700
                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-700
                    @elseif($order->status === 'completed') bg-green-100 text-green-700
                    @else bg-gray-200 text-gray-600 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>


            {{-- ================================
                    DETAIL ITEM PRODUK
            ================================= --}}
            <h2 class="text-xl font-bold mb-4">Daftar Produk</h2>

            @foreach ($order->items as $it)

                <div class="flex flex-col md:flex-row items-start md:items-center gap-4
                            bg-gray-50 p-4 rounded-xl shadow-sm mb-4 border">

                    {{-- IMAGE --}}
                    <div class="w-20 h-20 bg-white border rounded flex items-center justify-center">
                        <img src="{{ $it->product->image ? asset('storage/'.$it->product->image) : 'https://via.placeholder.com/150' }}"
                             class="object-cover h-full w-full rounded">
                    </div>

                    {{-- PRODUCT INFO --}}
                    <div class="flex-1">
                        <p class="font-semibold text-lg">{{ $it->product->name }}</p>
                        <p class="text-gray-600 text-sm">Jumlah: {{ $it->quantity }}</p>
                        <p class="text-green-700 font-bold">
                            Rp {{ number_format($it->price, 0, ',', '.') }}
                        </p>
                    </div>

                </div>

            @endforeach


            {{-- ================================
                    TOTAL HARGA
            ================================= --}}
            <div class="text-right mt-6">
                <p class="text-xl font-bold">
                    Total: 
                    <span class="text-green-700">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </p>
            </div>


            {{-- ================================
                    BUTTON UPDATE STATUS
            ================================= --}}
            @if(in_array($order->status, ['pending','packed','shipped']))
                <div class="mt-8 text-center">

                    <form action="{{ route('seller.orders.updateStatus', $order->id) }}"
                          method="POST" class="inline-block">
                        @csrf

                        @if ($order->status === 'pending')
                            <input type="hidden" name="status" value="packed">
                            <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg shadow font-semibold">
                                Tandai Dikemas
                            </button>

                        @elseif ($order->status === 'packed')
                            <input type="hidden" name="status" value="shipped">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow font-semibold">
                                Tandai Dikirim
                            </button>

                        @elseif ($order->status === 'shipped')
                            <input type="hidden" name="status" value="completed">
                            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow font-semibold">
                                Tandai Selesai
                            </button>
                        @endif
                    </form>

                </div>
            @endif

        </div>
    </div>

</x-app-layout>
