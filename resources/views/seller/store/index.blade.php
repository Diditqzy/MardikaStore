<x-dashboard-layout title="Store Information">

    <h1 class="text-2xl font-bold mb-4">Edit Store</h1>

    <form action="{{ route('seller.store.update') }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf

        <label class="block">Store Name</label>
        <input type="text" name="name" value="{{ $store->name ?? '' }}" class="w-full p-2 border rounded mb-4" required>

        <label class="block">Description</label>
        <textarea name="description" class="w-full p-2 border rounded mb-4">{{ $store->description ?? '' }}</textarea>

        <label class="block">Store Image</label>
        <input type="file" name="image" class="mb-4">

        @if ($store && $store->image)
            <img src="{{ asset('storage/'.$store->image) }}" class="h-32 mb-4 rounded">
        @endif

        <button class="bg-green-600 text-white px-4 py-2 rounded">Save Changes</button>
    </form>

</x-dashboard-layout>
