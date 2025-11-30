<x-app-layout title="Beri Review">

    {{-- STRIP MERAH ATAS --}}
    <div class="w-full h-24 bg-red-600"></div>
    {{-- ALERT SUCCESS --}}
@if(session('success'))
    <div class="max-w-3xl mx-auto mt-4">
        <div class="p-4 bg-green-100 text-green-800 border border-green-300 rounded-xl shadow">
            {{ session('success') }}
        </div>
    </div>
@endif

    {{-- WRAPPER UTAMA --}}
    <div class="max-w-3xl mx-auto -mt-12 bg-white shadow-lg rounded-2xl p-8 mb-20">

        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Beri Review
        </h1>

        {{-- PRODUCT BOX --}}
        <div class="flex items-center gap-4 bg-gray-50 p-4 border rounded-xl shadow mb-8">
            <div class="w-20 h-20 bg-white rounded-lg shadow flex items-center justify-center overflow-hidden">
                <img 
                    src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://via.placeholder.com/150' }}"
                    class="object-contain h-full"
                >
            </div>

            <div>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $item->product->name }}
                </p>
                <p class="text-gray-500 text-sm">
                    Jumlah: {{ $item->quantity }}
                </p>
            </div>
        </div>

        {{-- FORM --}}
        <form action="{{ route('buyer.review.store', $item->id) }}" method="POST">
            @csrf

            {{-- RATING --}}
            <label class="font-semibold text-gray-700">Rating</label>
            <select 
                name="rating" 
                class="w-full border p-3 rounded-xl mt-1 bg-white shadow-sm focus:ring-red-500 focus:border-red-500"
                required
            >
                <option value="">Pilih Rating...</option>
                <option value="5">⭐⭐⭐⭐⭐</option></option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>

            {{-- COMMENT --}}
            <label class="font-semibold text-gray-700 mt-4 block">Komentar (wajib)</label>
            <textarea 
                name="comment" 
                rows="3"
                placeholder="Tulis pengalamanmu dengan produk ini..."
                class="w-full border p-3 rounded-xl bg-white shadow-sm mt-1 focus:ring-red-500 focus:border-red-500"
                required
            ></textarea>

            {{-- BUTTON --}}
            
            <button 
                class="mt-6 w-full bg-green-600 text-white py-3 rounded-xl text-lg font-bold hover:bg-green-700 transition shadow-lg">
                Kirim Review
            </button>

        </form>

        {{-- BACK --}}
        <a href="{{ route('buyer.orders.index') }}"
           class="block text-center mt-4 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-300 transition shadow">
            Kembali ke Pesanan
        </a>

    </div>

</x-app-layout>
