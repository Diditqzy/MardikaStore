@if($item->order->status === 'completed' && !$item->review)
    <form action="{{ route('review.store', $item->id) }}" method="POST" class="mt-3">
        @csrf

        <label>Rating</label>
        <select name="rating" class="border p-2 rounded" required>
            <option value="">Pilih...</option>
            <option value="5">★★★★★ (5)</option>
            <option value="4">★★★★ (4)</option>
            <option value="3">★★★ (3)</option>
            <option value="2">★★ (2)</option>
            <option value="1">★ (1)</option>
        </select>

        <label class="block mt-2">Komentar (optional)</label>
        <textarea name="comment" class="border p-2 w-full rounded" rows="2"></textarea>

        <button class="mt-2 bg-green-600 text-white px-3 py-2 rounded">
            Kirim Review
        </button>
    </form>
@endif
