<h3>Reviews untuk {{ $buku->judul }}</h3>

@foreach ($buku->reviews as $review)
    <div class="review">
        <p>{{ $review->review }}</p>
        <p><strong>Tags:</strong> {{ implode(', ', $review->tags) }}</p>
        <p><small>Reviewed by: {{ $review->user->name }}</small></p>
    </div>
@endforeach
