<x-dashboard-layout title="Edit Product">

    <div class="max-w-xl bg-white shadow rounded p-6">

        <h2 class="text-xl font-bold mb-4">Edit Product</h2>
        @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- CATEGORY --}}
            <label class="block font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full p-2 border rounded mb-4">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            {{-- NAME --}}
            <label class="block font-semibold mb-1">Product Name</label>
            <input type="text"
                name="name"
                value="{{ $product->name }}"
                placeholder="contoh: Laptop ASUS ROG Strix"
                class="w-full p-2 border rounded mb-4"
                required>

            {{-- PRICE --}}
            <label class="block font-semibold mb-1">Price (Rp)</label>
            <input type="number"
                name="price"
                min="1"
                step="1"
                value="{{ $product->price }}"
                placeholder="contoh: 15000000"
                class="w-full p-2 border rounded mb-4"
                required>

            {{-- STOCK --}}
            <label class="block font-semibold mb-1">Stock</label>
            <input type="number"
                name="stock"
                min="1"
                value="{{ $product->stock }}"
                placeholder="contoh: 5"
                class="w-full p-2 border rounded mb-4"
                required>

            {{-- DESCRIPTION --}}
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description"
                class="w-full p-2 border rounded mb-4">{{ $product->description }}</textarea>

            {{-- IMAGE --}}
            <label class="block font-semibold mb-1">Current Image</label>
            @if ($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="h-20 mb-4">
            @endif

            <label class="block font-semibold mb-1">Change Image</label>
            <input type="file" name="image" class="mb-1">

            <p class="text-sm text-gray-500 mb-4">
                Allowed: JPG, JPEG, PNG, SVG — Max 2MB
            </p>


            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                Update Product
            </button>
        </form>
        <script>
            document.querySelectorAll('input[type="number"]').forEach(function(input) {

                input.addEventListener('input', function() {

                    // Hapus semua karakter selain angka
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Cegah angka 0 dan nilai kosong menjadi 1
                    if (this.value !== '' && parseInt(this.value) < 1) {
                        this.value = '';
                    }
                });

            });
        </script>
    </div>

</x-dashboard-layout>
