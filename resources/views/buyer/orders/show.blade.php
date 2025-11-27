<x-dashboard-layout title="Detail Pesanan">

    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>

        <p class="mb-2">Status: <span class="font-semibold">{{ $order->status }}</span></p>
        <p class="mb-2">Nama: {{ $order->name }}</p>
        <p class="mb-2">Phone: {{ $order->phone }}</p>
        <p class="mb-2">Alamat: {{ $order->address }}</p>

        <hr class="my-4">

        <h3 class="font-semibold mb-3">Items</h3>
        @foreach ($order->items as $it)
            <div class="flex items-center gap-4 mb-3">
                <div class="w-16 h-16 bg-gray-100 flex items-center justify-center">
                    <img src="{{ $it->product->image ? asset('storage/'.$it->product->image) : 'https://via.placeholder.com/150' }}" class="object-contain h-full">
                </div>
                <div class="flex-1">
                    <div class="font-semibold">{{ $it->product->name }}</div>
                    <div class="text-sm">Qty: {{ $it->quantity }}</div>
                    <div class="text-blue-600 font-bold">Rp {{ number_format($it->price,0,',','.') }}</div>
                </div>
            </div>
        @endforeach

        <div class="mt-4 text-right">
            <p class="font-bold">Total: Rp {{ number_format($order->total_price,0,',','.') }}</p>
        </div>

        <div class="mt-4">
            @if($order->status === 'pending')
                <form action="{{ route('buyer.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Yakin batalkan order ini?')">
                    @csrf
                    <button class="bg-red-600 text-white px-4 py-2 rounded">Batalkan Order</button>
                </form>
            @endif
        </div>

    </div>

</x-dashboard-layout>
