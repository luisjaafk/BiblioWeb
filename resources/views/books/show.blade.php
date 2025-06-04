@extends('layouts.app')

@section('title', $book->title . ' - Detalles')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow" style="background: #292929; border-radius: 12px;">
                <img 
                    src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x450.png?text=Portada+no+disponible' }}" 
                    class="card-img-top" 
                    alt="{{ $book->title }}" 
                    style="height: 450px; width: 100%; object-fit: cover; border-radius: 12px 12px 0 0;"
                >

                <div class="card-body text-center">
                    <span class="badge {{ $book->status === 'disponible' ? 'bg-success' : 'bg-danger' }}" style="font-size: 0.9rem;">
                        {{ ucfirst($book->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <h2 style="color: #9b59b6;">{{ $book->title }}</h2>
            <h5 class="text-muted mb-3">{{ $book->author }}</h5>

            <p style="color: #ccc;"><strong>Descripción:</strong> {{ $book->description ?? 'No disponible' }}</p>
            <p style="color: #ccc;"><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p style="color: #ccc;"><strong>Categoría:</strong> 
                <span class="badge" style="background-color: #8e44ad; color: white;">{{ $book->category }}</span>
            </p>

            @if($book->status === 'disponible')
                <form action="{{ route('loans.store') }}" method="POST" class="d-inline-block mt-3 me-2">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-book-reader me-1"></i> Pedir prestado
                    </button>
                </form>
            @endif

            <a href="{{ route('books.index') }}" class="btn btn-outline-light mt-3">
                <i class="fas fa-arrow-left me-1"></i> Volver al catálogo
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: #1c1c1c;
        color: #eee;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
        box-shadow: 0 8px 20px rgba(155, 89, 182, 0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(155, 89, 182, 0.7);
    }
    .btn-success {
        background-color: #27ae60;
        border-color: #27ae60;
        font-weight: 600;
    }
    .btn-outline-light {
        border-color: #ccc;
        color: #ccc;
    }
    .btn-outline-light:hover {
        background-color: #9b59b6;
        border-color: #9b59b6;
        color: white;
    }
</style>
@endpush
