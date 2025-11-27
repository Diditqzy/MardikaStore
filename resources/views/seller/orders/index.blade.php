<x-dashboard-layout title="Pesanan Masuk">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Pesanan Masuk</h1>

        @foreach ($orders as $o)
            <div class="bg-white p-4 rounded shadow mb-3 flex justify-between items-center">
                <div>
                    <h3 class="font-semibold">Order #{{ $o->id }}</h3>
                    <p class="text-sm text-gray-600">Buyer: {{ $o->buyer->name }}</p>
                    <p class="text-sm text-gray-600">Tanggal: {{ $o->created_at->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold">Rp {{ number_format($o->total_price,0,',','.') }}</p>
                    <p class="text-sm">Status: {{ $o->status }}</p>
                    <a href="{{ route('seller.orders.show', $o->id) }}" class="text-blue-600">Detail</a>
                </div>
            </div>
        @endforeach

        <div class="mt-4">{{ $orders->links() }}</div>
    </div>
</x-dashboard-layout>
