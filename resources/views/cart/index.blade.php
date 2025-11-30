<x-app-layout title="Keranjang Belanja">

    {{-- STRIP MERAH ATAS --}}
    <div class="w-full h-24 bg-red-600"></div>

    {{-- WRAPPER PUTIH UTAMA --}}
    <div class="max-w-5xl mx-auto -mt-12 bg-white rounded-2xl shadow p-6 mb-16">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Keranjang Belanja</h1>

            <a href="{{ route('buyer.dashboard') }}"
               class="bg-red-600 text-white px-5 py-2 rounded-xl hover:bg-red-700 transition">
                Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        {{-- KERANJANG KOSONG --}}
        @if ($cart->items->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow">
                <p class="text-xl font-semibold text-gray-700 mb-2">Keranjang Anda kosong.</p>
                <p class="text-gray-500 mb-6">Tambahkan produk ke keranjang untuk mulai belanja.</p>

                <a href="{{ route('buyer.dashboard') }}"
                   class="inline-block bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700 transition">
                    Kembali Belanja
                </a>
            </div>
        @else

        {{-- FORM CHECKOUT --}}
        <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
            @csrf

            <div class="space-y-5">

                {{-- ITEM LIST --}}
                @foreach ($cart->items as $item)
                <div class="flex gap-4 items-center bg-gray-50 p-4 rounded-2xl shadow relative hover:bg-red-50 transition">

                    {{-- CHECKBOX --}}
                    <input type="checkbox"
                           name="selected_items[]"
                           value="{{ $item->id }}"
                           class="selected-item w-5 h-5 accent-red-600"
                           onchange="recalcTotal()">

                    {{-- IMAGE --}}
                    <div class="w-24 h-24 bg-white rounded-xl shadow flex justify-center items-center overflow-hidden">
                        <img src="{{ asset('storage/'.$item->product->image) }}" class="object-contain h-full">
                    </div>

                    {{-- INFO --}}
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg">{{ $item->product->name }}</h3>

                        <p class="text-red-600 font-bold text-lg priceText"
                           data-price="{{ $item->price }}">
                            Rp {{ number_format($item->price,0,',','.') }}
                        </p>

                        {{-- QTY --}}
                        <div class="flex items-center gap-2 mt-2">

                            <button type="button"
                                    onclick="qtyMinus({{ $item->id }})"
                                    class="w-8 h-8 bg-gray-200 rounded-lg hover:bg-gray-300">
                                -
                            </button>

                            <input type="text"
                                   id="qty_{{ $item->id }}"
                                   class="qtyInput w-12 text-center border rounded-lg"
                                   value="{{ $item->quantity }}"
                                   data-id="{{ $item->id }}"
                                   data-stock="{{ $item->product->stock }}"
                                   oninput="qtyManual({{ $item->id }})">

                            <button type="button"
                                    onclick="qtyPlus({{ $item->id }}, {{ $item->product->stock }})"
                                    class="w-8 h-8 bg-gray-200 rounded-lg hover:bg-gray-300">
                                +
                            </button>

                        </div>
                    </div>

                    {{-- DELETE --}}
                    <button type="button"
                            class="absolute top-3 right-3 text-red-600 hover:text-red-800"
                            onclick="deleteItem({{ $item->id }})">
                        Hapus
                    </button>

                </div>
                @endforeach

                {{-- TOTAL --}}
                <div class="bg-white p-4 rounded-2xl shadow text-right">
                    <p class="text-gray-600">Total Dipilih:</p>
                    <p id="checkoutTotal" class="text-2xl font-bold text-red-600">Rp 0</p>
                </div>

                {{-- ALAMAT PENGIRIMAN --}}
                <div class="bg-white p-6 rounded-2xl shadow">

                    <h3 class="text-xl font-semibold mb-4">Alamat Pengiriman</h3>

                    <label class="font-semibold">Nama</label>
                    <input type="text" name="name" required class="w-full p-3 border rounded-xl mb-4">

                    <label class="font-semibold">Nomor HP</label>
                    <input type="text"
                           name="phone"
                           required
                           oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                           class="w-full p-3 border rounded-xl mb-4">

                    <label class="font-semibold">Alamat Lengkap</label>
                    <textarea name="address" required class="w-full p-3 border rounded-xl mb-4"></textarea>

                    <label class="font-semibold">Catatan</label>
                    <textarea name="notes" class="w-full p-3 border rounded-xl mb-6"></textarea>

                    <button class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 float-right">
                        Checkout Dipilih
                    </button>

                </div>

            </div>

        </form>

        @endif

    </div>


{{-- JAVASCRIPT LOGIC --}}
<script>
function formatRp(num){
    return 'Rp ' + Number(num).toLocaleString('id-ID');
}

function recalcTotal(){
    let total = 0;

    document.querySelectorAll('.selected-item:checked').forEach(cb => {
        const card = cb.closest('.flex');
        const price = Number(card.querySelector('.priceText').dataset.price);
        const qty = Number(card.querySelector('.qtyInput').value);
        total += price * qty;
    });

    document.getElementById('checkoutTotal').innerText = formatRp(total);
}

function ajaxQty(id, qty){
    fetch(`/cart/item/${id}/ajax`, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ quantity : qty })
    }).then(res => res.json())
    .then(() => recalcTotal());
}

function qtyMinus(id){
    let input = document.getElementById('qty_'+id);
    let current = Number(input.value);
    if(current > 1){
        input.value = current - 1;
        ajaxQty(id, current - 1);
    }
}

function qtyPlus(id, stock){
    let input = document.getElementById('qty_'+id);
    let current = Number(input.value);
    if(current < stock){
        input.value = current + 1;
        ajaxQty(id, current + 1);
    }
}

function qtyManual(id){
    let input = document.getElementById('qty_'+id);
    let val = Number(input.value || 1);
    ajaxQty(id, val);
}

function deleteItem(id){
    fetch(`/cart/item/${id}`,{
        method: "DELETE",
        headers:{
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    }).then(() => location.reload());
}
</script>

</x-app-layout>
