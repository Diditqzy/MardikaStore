<x-public-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Order Berhasil</h1>
        <p class="mb-4">Terima kasih. Order Anda telah dibuat. Nomor order: <span class="font-semibold">#{{ $order->id }}</span></p>

        <div class="bg-white p-4 rounded shadow">
            <p>Subtotal: Rp {{ number_format($order->total_price,0,',','.') }}</p>
            <p>Status: {{ ucfirst($order->status) }}</p>
            <a href="{{ route('buyer.orders.show', $order->id) }}" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded">Lihat Pesanan Saya</a>
        </div>
    </div>
</x-public-layout>
