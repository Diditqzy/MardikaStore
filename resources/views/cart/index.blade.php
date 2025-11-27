<x-dashboard-layout title="Keranjang Belanja">

<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if ($cart->items->isEmpty())
        <p class="text-gray-600">Keranjang Anda kosong.</p>
    @else

    <!-- ============================= -->
    <!-- FORM CHECKOUT (POST SAJA)    -->
    <!-- ============================= -->
    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf

        <div class="space-y-4">

            @foreach ($cart->items as $item)
                <div class="flex gap-4 items-center bg-white p-4 rounded shadow relative">

                    <!-- CHECKBOX -->
                    <input type="checkbox"
                           name="selected_items[]"
                           value="{{ $item->id }}"
                           class="selected-item"
                           onchange="recalcTotal()">

                    <!-- IMAGE -->
                    <div class="w-20 h-20 overflow-hidden flex justify-center items-center">
                        <img src="{{ asset('storage/'.$item->product->image) }}" class="object-contain h-full">
                    </div>

                    <!-- PRODUCT INFO -->
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $item->product->name }}</h3>

                        <p class="text-blue-600 font-bold priceText"
                           data-price="{{ $item->price }}">
                            Rp {{ number_format($item->price,0,',','.') }}
                        </p>

                        <!-- QTY AJAX -->
                        <div class="flex items-center gap-2 mt-2">

                            <button type="button"
                                    onclick="qtyMinus({{ $item->id }})"
                                    class="w-7 h-7 bg-gray-200 rounded">
                                -
                            </button>

                            <input type="text"
                                   id="qty_{{ $item->id }}"
                                   class="qtyInput w-12 text-center border rounded"
                                   value="{{ $item->quantity }}"
                                   data-id="{{ $item->id }}"
                                   data-stock="{{ $item->product->stock }}"
                                   oninput="qtyManual({{ $item->id }})">

                            <button type="button"
                                    onclick="qtyPlus({{ $item->id }}, {{ $item->product->stock }})"
                                    class="w-7 h-7 bg-gray-200 rounded">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- DELETE BUTTON (OUTSIDE FORM CHECKOUT!!!) -->
                    <button type="button"
                            class="absolute top-2 right-2 text-red-600"
                            onclick="deleteItem({{ $item->id }})">
                        Hapus
                    </button>

                </div>
            @endforeach

            <!-- TOTAL -->
            <div class="bg-white p-4 rounded shadow text-right">
                <p>Total Dipilih:</p>
                <p id="checkoutTotal" class="text-xl font-bold">Rp 0</p>
            </div>

            <!-- SHIPPING INFO -->
            <div class="bg-white p-4 rounded shadow">

                <h3 class="font-semibold mb-3">Alamat Pengiriman</h3>

                <label>Nama</label>
                <input type="text" name="name" required class="w-full p-2 border rounded mb-3">

                <label>Nomor HP</label>
                <input type="text"
                       name="phone"
                       required
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                       class="w-full p-2 border rounded mb-3">

                <label>Alamat</label>
                <textarea name="address" required class="w-full p-2 border rounded mb-3"></textarea>

                <label>Catatan</label>
                <textarea name="notes" class="w-full p-2 border rounded mb-3"></textarea>

                <button class="bg-green-600 text-white px-4 py-2 rounded float-right">
                    Checkout Dipilih
                </button>

            </div>

        </div>
    </form>

    @endif

</div>

<script>
/* ==========================
   HELPER FORMAT RUPIAH
========================== */
function formatRp(num){
    return 'Rp ' + Number(num).toLocaleString('id-ID');
}

/* ==========================
   HITUNG TOTAL
========================== */
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

/* ==========================
   UPDATE QTY VIA AJAX
========================== */
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

/* MINUS */
function qtyMinus(id){
    let input = document.getElementById('qty_'+id);
    let current = Number(input.value);
    if(current > 1){
        input.value = current - 1;
        ajaxQty(id, current - 1);
    }
}

/* PLUS */
function qtyPlus(id, stock){
    let input = document.getElementById('qty_'+id);
    let current = Number(input.value);
    if(current < stock){
        input.value = current + 1;
        ajaxQty(id, current + 1);
    }
}

/* MANUAL INPUT */
function qtyManual(id){
    let input = document.getElementById('qty_'+id);
    let value = Number(input.value || 1);
    ajaxQty(id, value);
}

/* DELETE ITEM (AJAX) */
function deleteItem(id){
    fetch(`/cart/item/${id}`,{
        method: "DELETE",
        headers:{
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    }).then(() => location.reload());
}
</script>

</x-dashboard-layout>
