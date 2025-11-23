<x-dashboard-layout title="Create Category">

    <form action="{{ route('admin.categories.store') }}" method="POST" class="max-w-md">
        @csrf

        <label>Name</label>
        <input type="text" name="name" class="w-full p-2 border rounded mb-3">

        <label>Description</label>
        <textarea name="description" class="w-full p-2 border rounded mb-3"></textarea>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>

</x-dashboard-layout>
