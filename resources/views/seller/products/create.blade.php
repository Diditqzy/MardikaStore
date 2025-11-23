<x-dashboard-layout title="Add Product">

    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf

        <label>Category</label>
        <select name="category_id" class="w-full p-2 border rounded mb-4">
            @foreach ($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <label>Name</label>
        <input type="text" name="name" class="w-full p-2 border rounded mb-4">

        <label>Price</label>
        <input type="number" name="price" step="0.01" class="w-full p-2 border rounded mb-4">

        <label>Stock</label>
        <input type="number" name="stock" class="w-full p-2 border rounded mb-4">

        <label>Description</label>
        <textarea name="description" class="w-full p-2 border rounded mb-4"></textarea>

        <label>Image</label>
        <input type="file" name="image" class="mb-4">

        <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>

</x-dashboard-layout>
