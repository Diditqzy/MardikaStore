<x-dashboard-layout title="Pending Sellers">

    <h1 class="text-2xl font-bold mb-4">Pending Seller Requests</h1>

    <table class="w-full bg-white shadow">
        <tr class="border-b">
            <th class="p-3">Name</th>
            <th class="p-3">Email</th>
            <th class="p-3">Action</th>
        </tr>

        @foreach($sellers as $seller)
        <tr class="border-b">
            <td class="p-3">{{ $seller->name }}</td>
            <td class="p-3">{{ $seller->email }}</td>
            <td class="p-3 flex gap-2">

                <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST">
                    @csrf
                    <button class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
                </form>

                <form action="{{ route('admin.sellers.reject', $seller->id) }}" method="POST">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>

</x-dashboard-layout>
