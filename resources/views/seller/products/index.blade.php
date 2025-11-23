<x-dashboard-layout title="My Products">

    <a href="{{ route('seller.products.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">Add Product</a>
       @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <table class="w-full bg-white mt-5 shadow">
        <tr>
            <th class="p-3">Image</th>
            <th class="p-3">Name</th>
            <th class="p-3">Price</th>
            <th class="p-3">Stock</th>
            <th class="p-3">Actions</th>
        </tr>

        @foreach ($products as $p)
        <tr class="border-b">
            <td class="p-3">
                @if($p->image)
                    <img src="{{ asset('storage/'.$p->image) }}" class="h-16">
                @endif
            </td>
            <td class="p-3">{{ $p->name }}</td>
            <td class="p-3">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
            <td class="p-3">{{ $p->stock }}</td>
            <td class="p-3">
                <a href="{{ route('seller.products.edit', $p->id) }}" class="text-blue-600">Edit</a>
                <form action="{{ route('seller.products.delete', $p->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 ml-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
</x-dashboard-layout>
