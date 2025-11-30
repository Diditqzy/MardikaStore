<x-app-layout title="Detail Pesanan">

    {{-- STRIP MERAH ATAS --}}
    <div class="w-full h-24 bg-red-600"></div>

    {{-- WRAPPER UTAMA --}}
    <div class="max-w-3xl mx-auto -mt-12 bg-white shadow-lg rounded-2xl p-8 mb-20">

        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Detail Pesanan #{{ $order->id }}
        </h1>

        {{-- STATUS BOX --}}
        <div class="bg-gray-50 p-5 rounded-xl border shadow-sm mb-8">
            <p class="text-lg">
                <span class="font-semibold text-gray-700">Status:</span>
                <span class="font-bold capitalize 
                     @if($order->status === 'pending') text-yellow-600
                     @elseif($order->status === 'cancelled') text-red-600
                     @else text-green-600
                     @endif">
                     {{ $order->status }}
                </span>
            </p>

            <p class="mt-2 text-gray-700"><span class="font-semibold">Nama:</span> {{ $order->name }}</p>
            <p class="text-gray-700"><span class="font-semibold">Phone:</span> {{ $order->phone }}</p>
            <p class="text-gray-700"><span class="font-semibold">Alamat:</span> {{ $order->address }}</p>
        </div>

        {{-- ITEM LIST --}}
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Daftar Produk</h3>

        <div class="space-y-5">
            @foreach ($order->items as $it)

                <div class="flex gap-4 bg-gray-50 p-4 rounded-xl shadow hover:bg-red-50 transition">

                    {{-- PRODUCT IMAGE --}}
                    <div class="w-20 h-20 bg-white rounded-lg shadow flex items-center justify-center overflow-hidden">
                        <img src="{{ $it->product->image ? asset('storage/'.$it->product->image) : 'https://via.placeholder.com/150' }}"
                             class="object-contain h-full">
                    </div>

                    {{-- PRODUCT INFO --}}
                    <div class="flex-1">
                        <div class="font-semibold text-gray-900 text-lg">
                            {{ $it->product->name }}
                        </div>
                        <div class="text-gray-600 text-sm">
                            Jumlah: {{ $it->quantity }}
                        </div>
                        <div class="text-red-600 font-bold text-lg">
                            Rp {{ number_format($it->price,0,',','.') }}
                        </div>
                            @if($order->status === 'completed')
                                <a href="{{ route('buyer.orders.review', $it->id) }}"
                                    class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition shadow">
                                    Beri Review
                                </a>
                            @endif

                    </div>
                    
                    

                </div>
            @endforeach
            
        </div>

        {{-- TOTAL --}}
        <div class="mt-6 bg-white p-4 text-right rounded-xl shadow border">
            <p class="text-lg text-gray-700">Total Pembayaran:</p>
            <p class="text-3xl font-extrabold text-red-600">
                Rp {{ number_format($order->total_price,0,',','.') }}
            </p>
        </div>

        {{-- ACTION BUTTON --}}
        <div class="mt-8 flex gap-4">

            {{-- CANCEL BUTTON --}}
            @if($order->status === 'pending')
                <form action="{{ route('buyer.orders.cancel', $order->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin batalkan order ini?')">
                    @csrf
                    <button class="bg-red-600 text-white px-5 py-3 rounded-xl font-semibold hover:bg-red-700 transition shadow">
                        Batalkan Order
                    </button>
                </form>
            @endif
            

            {{-- BACK TO ORDERS --}}
            <a href="{{ route('buyer.orders.index') }}"
               class="bg-gray-200 text-gray-800 px-5 py-3 rounded-xl font-semibold hover:bg-gray-300 transition shadow">
                Kembali ke Pesanan
            </a>

        </div>

    </div>

</x-app-layout>
