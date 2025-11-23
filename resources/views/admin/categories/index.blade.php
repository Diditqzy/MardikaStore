<x-dashboard-layout title="Category Management">

    <a href="{{ route('admin.categories.create') }}" 
       class="bg-green-500 text-white px-4 py-2 rounded">Add Category</a>

    <table class="mt-4 w-full bg-white shadow">
        <tr class="border-b">
            <th class="p-3">Name</th>
            <th class="p-3">Description</th>
            <th class="p-3">Actions</th>
        </tr>

        @foreach ($categories as $cat)
        <tr class="border-b">
            <td class="p-3">{{ $cat->name }}</td>
            <td class="p-3">{{ $cat->description }}</td>
            <td class="p-3">
                <a class="text-blue-500" href="{{ route('admin.categories.edit', $cat->id) }}">Edit</a>

                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 ml-2" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</x-dashboard-layout>
