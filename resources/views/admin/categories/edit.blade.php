<x-dashboard-layout title="Edit Category">

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="max-w-md">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ $category->name }}" class="w-full p-2 border rounded mb-3">

        <label>Description</label>
        <textarea name="description" class="w-full p-2 border rounded mb-3">{{ $category->description }}</textarea>

        <button class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>

</x-dashboard-layout>
