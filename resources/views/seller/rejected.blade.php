<x-app-layout>
    <div class="text-center p-8">
        <h1 class="text-2xl font-bold mb-4">Akun Seller Ditolak</h1>
        <p class="mb-4">Akun Anda telah ditolak oleh Admin.</p>
        <form action="{{ route('seller.delete.account') }}" method="POST" onsubmit="return confirm('Delete your account permanently?')">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Delete Account
            </button>
        </form>
    </div>
</x-app-layout>
