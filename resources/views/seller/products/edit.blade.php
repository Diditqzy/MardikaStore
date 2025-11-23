<x-dashboard-layout title="Edit Product">

    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf

        <label>Category</label>
        <select name="category_id" class="w-full p-2 border rounded mb-4">
            @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
            @endforeach
        </select>

        <label>Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full p-2 border rounded mb-4">

        <label>Price</label>
        <input type="number" name="price" value="{{ $product->price }}" step="0.01" class="w-full p-2 border rounded mb-4">

        <label>Stock</label>
        <input type="number" name="stock" value="{{ $product->stock }}" class="w-full p-2 border rounded mb-4">

        <label>Description</label>
        <textarea name="description" class="w-full p-2 border rounded mb-4">{{ $product->description }}</textarea>

        <label>Image</label>
        <input type="file" name="image" class="mb-4">

        @if ($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="h-20 mb-4">
        @endif

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>

</x-dashboard-layout>
