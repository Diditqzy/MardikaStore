<x-dashboard-layout title="Keranjang Belanja">

    <div class="max-w-4xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($cart->items->isEmpty())
            <p class="text-gray-600">Keranjang Anda kosong.</p>
        @else
            <div class="space-y-4">

                @foreach ($cart->items as $item)
                    <div class="flex gap-4 items-center bg-white p-4 rounded shadow">
                        <div class="w-24 h-24 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://via.placeholder.com/150' }}"
                                 class="object-contain h-full">
                        </div>

                        <div class="flex-1">
                            <h3 class="font-semibold">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-600">Toko: {{ $item->product->store->name ?? '-' }}</p>
                            <p class="text-blue-600 font-bold">Rp {{ number_format($item->price,0,',','.') }}</p>

                            <form action="{{ route('cart.update', $item->id) }}" 
                                method="POST" 
                                class="flex items-center gap-2">

                                @csrf
                                @method('PATCH')

                                <!-- MINUS BUTTON -->
                                <button type="button"
                                    onclick="cartMinus({{ $item->id }})"
                                    class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded flex items-center justify-center text-xl font-bold">
                                    -
                                </button>

                                <!-- INPUT -->
                                <input 
                                    type="text"
                                    id="qtyInput_{{ $item->id }}"
                                    name="quantity"
                                    value="{{ $item->quantity }}"
                                    class="w-14 p-1 border rounded text-center"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                >

                                <!-- PLUS BUTTON -->
                                <button type="button"
                                    onclick="cartPlus({{ $item->id }}, {{ $item->product->stock }})"
                                    class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded flex items-center justify-center text-xl font-bold">
                                    +
                                </button>

                                <!-- UPDATE -->
                                <button type="submit"
                                    class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Update
                                </button>
                            </form>
                        </div>

                        <div class="text-right">
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                    <div>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="text-sm text-red-600">Kosongkan Keranjang</button>
                        </form>
                    </div>

                    <div class="text-right">
                        <p class="text-gray-600">Subtotal:</p>
                        <p class="text-xl font-bold">Rp {{ number_format($cart->total(),0,',','.') }}</p>
                        <p class="text-sm text-gray-500">Belum termasuk ongkir</p>
                    </div>
                </div>

            </div>
        @endif

    </div>
    <script>
    // Kurangi Qty
    function cartMinus(id) {
        let input = document.getElementById('qtyInput_' + id);
        let current = parseInt(input.value || "1");

        if (current > 1) {
            input.value = current - 1;
        }
    }

    // Tambah Qty
    function cartPlus(id, stock) {
        let input = document.getElementById('qtyInput_' + id);
        let current = parseInt(input.value || "1");

        if (current < stock) {
            input.value = current + 1;
        }
    }
</script>


</x-dashboard-layout>
