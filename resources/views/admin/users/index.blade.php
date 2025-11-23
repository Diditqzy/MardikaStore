<x-dashboard-layout title="User Management">

    <h1 class="text-2xl font-bold mb-4">All Users</h1>

    <table class="w-full bg-white shadow">
        <tr class="border-b">
            <th class="p-3">Name</th>
            <th class="p-3">Email</th>
            <th class="p-3">Role</th>
            <th class="p-3">Status</th>
        </tr>

        @foreach($users as $u)
        <tr class="border-b">
            <td class="p-3">{{ $u->name }}</td>
            <td class="p-3">{{ $u->email }}</td>
            <td class="p-3 capitalize">{{ $u->role }}</td>
            <td class="p-3 capitalize">{{ $u->status }}</td>
        </tr>
        @endforeach
    </table>

</x-dashboard-layout>
