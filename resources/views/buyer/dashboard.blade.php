<x-dashboard-layout title="Buyer Dashboard">

    <div class="max-w-7xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ auth()->user()->name }}</h1>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-6">Rekomendasi Produk</h2>

        <!-- SEARCH + CATEGORY FILTER -->
        <form method="GET" class="flex gap-3 mb-8">

            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari produk..."
                class="w-full p-3 border rounded"
            >

            <select name="category_id" class="p-3 border rounded">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option 
                        value="{{ $cat->id }}" 
                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 rounded">Filter</button>

        </form>

        <!-- PRODUCT GRID -->
        @if ($products->count() === 0)
            <p class="text-gray-600">Tidak ada produk ditemukan.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($products as $p)
                    <div class="bg-white shadow hover:shadow-lg transition rounded overflow-hidden">

                        <a href="{{ route('product.detail', $p->id) }}">

                            <div class="w-full h-56 bg-white flex items-center justify-center overflow-hidden">
                                <img 
                                    src="{{ $p->image ? asset('storage/'.$p->image) : 'https://via.placeholder.com/300' }}"
                                    class="object-contain h-full"
                                >
                            </div>

                        </a>

                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1">{{ $p->name }}</h3>

                            <p class="text-blue-600 font-bold mb-1">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </p>

                            <p class="text-gray-500 text-sm mb-3">
                                {{ $p->store->name ?? 'Unknown Store' }}
                            </p>

                            <a href="{{ route('product.detail', $p->id) }}"
                               class="inline-block bg-green-600 text-white px-3 py-2 rounded text-sm">
                                Lihat Detail
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif

    </div>

</x-dashboard-layout>
