@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Review dengan Tag "{{ ucfirst($tag) }}"</h1>
    @if($reviews->isEmpty())
        <p class="text-center">Belum ada review dengan tag ini.</p>
    @else
        <ul class="list-group">
            @foreach ($reviews as $review)
                <li class="list-group-item">
                    <h5>{{ $review->buku->judul }}</h5>
                    <p>{{ $review->review }}</p>
                    <p><strong>Tags:</strong> {{ implode(', ', $review->tags ?? []) }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
