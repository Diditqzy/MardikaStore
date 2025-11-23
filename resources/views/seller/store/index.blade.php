<x-dashboard-layout title="Store Information">

    <h1 class="text-2xl font-bold mb-4">Edit Store</h1>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seller.store.update') }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf

        <label class="block">Store Name</label>
        <input type="text" name="name" value="{{ $store->name ?? '' }}" class="w-full p-2 border rounded mb-4" required>

        <label class="block">Description</label>
        <textarea name="description" class="w-full p-2 border rounded mb-4">{{ $store->description ?? '' }}</textarea>

        <label class="block font-semibold mb-1">Store Image</label>
        <input type="file" name="image" class="mb-1">

        <p class="text-sm text-gray-500 mb-4">
            Allowed: JPG, JPEG, PNG, SVG — Max 2MB
        </p>

        @if ($store && $store->image)
            <img src="{{ asset('storage/'.$store->image) }}" class="h-32 mb-4 rounded">
        @endif

        <button class="bg-green-600 text-white px-4 py-2 rounded">Save Changes</button>
    </form>

</x-dashboard-layout>
