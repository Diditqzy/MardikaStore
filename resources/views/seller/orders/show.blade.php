<x-dashboard-layout title="Detail Pesanan">

    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>

        <p class="mb-2">Status: <span class="font-semibold">{{ $order->status }}</span></p>

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

        @if(in_array($order->status, ['pending','packed','shipped']))
            <div class="mt-4">
                <form action="{{ route('seller.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <!-- show only valid next action -->
                    @if ($order->status === 'pending')
                        <input type="hidden" name="status" value="packed">
                        <button class="bg-yellow-600 text-white px-4 py-2 rounded">Mark Packed</button>
                    @elseif ($order->status === 'packed')
                        <input type="hidden" name="status" value="shipped">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Mark Shipped</button>
                    @elseif ($order->status === 'shipped')
                        <input type="hidden" name="status" value="completed">
                        <button class="bg-green-600 text-white px-4 py-2 rounded">Mark Completed</button>
                    @endif
                </form>
            </div>
        @endif

    </div>

</x-dashboard-layout>
