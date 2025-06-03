@extends('layouts.app')

@section('title', 'Catálogo - BiblioWeb')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 style="color: #9b59b6; font-weight: 700; text-shadow: 1px 1px 4px #5e3370;">
                <i class="fas fa-book-open me-2"></i>Catálogo de Libros
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Nuevo Libro
            </a>
        </div>
    </div>

    {{-- Filtros de búsqueda y estado --}}
    <form method="GET" action="{{ route('books.index') }}" class="row g-3 mb-4">
        <div class="col-md-6">
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Buscar por título, autor o ISBN..."
                autocomplete="off"
            />
        </div>
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="" {{ request('status') === null || request('status') === '' ? 'selected' : '' }}>Estado: Todos</option>
                <option value="disponible" {{ request('status') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="prestado" {{ request('status') === 'prestado' ? 'selected' : '' }}>Prestado</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <div id="books-container" class="row row-cols-1 row-cols-md-3 g-4">
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

        @if($books->isEmpty())
            <div class="col-12">
                <div class="alert alert-info text-center" style="background-color: #444; color: #ddd; border-color: #666; border-radius: 12px;">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>No se encontraron libros</h4>
                    <p>Parece que no hay libros en el catálogo todavía.</p>
                    <a href="{{ route('books.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-1"></i> Agregar Primer Libro
                    </a>
                </div>
            </div>
        @else
            @foreach ($books as $book)
                <div class="col">
                    <div class="card h-100 book-card" style="background: #292929; border-radius: 12px; box-shadow: 0 8px 20px rgba(155, 89, 182, 0.4); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div class="position-relative">
                            <img 
                                src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x450.png?text=Portada+no+disponible' }}" 
                                class="card-img-top" 
                                alt="{{ $book->title }}" 
                                style="height: 300px; object-fit: cover;"
                                >

                            <span class="position-absolute top-0 end-0 m-2 badge {{ $book->status === 'disponible' ? 'bg-success' : 'bg-danger' }} availability-badge" style="font-size: 0.75rem; font-weight: 600; padding: 0.25em 0.6em; border-radius: 15px; opacity: 0.85;">
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="color: #ddd;">{{ $book->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
                            <p class="card-text text-truncate" style="color: #bbb;">{{ $book->description ?? 'Descripción no disponible' }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">ISBN: {{ $book->isbn }}</small>
                                <span class="badge bg-info" style="background-color: #8e44ad !important; color: #fff !important; font-weight: 600;">{{ $book->category }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-outline-primary" style="color: #9b59b6; border-color: #9b59b6;">
                                    <i class="fas fa-eye"></i> Detalles
                                </a>
                                <div class="d-flex">
                                    @if($book->status === 'disponible')
                                        <form action="{{ route('loans.store') }}" method="POST" class="me-1">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Pedir prestado" style="color: #27ae60; border-color: #27ae60;">
                                                <i class="fas fa-book-reader"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-secondary me-1" title="Editar" style="color: #7f8c8d; border-color: #7f8c8d;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este libro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar" style="color: #e74c3c; border-color: #e74c3c;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Paginación --}}
<div class="mt-4 d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg">
            {{-- Previous Page Link --}}
            @if ($books->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" style="background-color: #292929; border-color: #555; color: #555;">
                        <i class="fas fa-angle-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $books->previousPageUrl() }}" rel="prev" style="background-color: #292929; border-color: #9b59b6; color: #9b59b6;">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                @if ($page == $books->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link" style="background-color: #9b59b6; border-color: #9b59b6; color: white;">
                            {{ $page }}
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}" style="background-color: #292929; border-color: #9b59b6; color: #9b59b6;">
                            {{ $page }}
                        </a>
                    </li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($books->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $books->nextPageUrl() }}" rel="next" style="background-color: #292929; border-color: #9b59b6; color: #9b59b6;">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" style="background-color: #292929; border-color: #555; color: #555;">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
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
    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 25px rgba(155, 89, 182, 0.7);
    }
    .form-control, .form-select {
        background-color: #222;
        border: 1px solid #555;
        color: #eee;
        border-radius: 8px;
        transition: border-color 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #9b59b6;
        box-shadow: 0 0 8px #9b59b6;
        background-color: #222;
        color: #eee;
    }
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    /* Paginación sin bootstrap */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 20px 0 0 0;
        gap: 8px;
    }
    .pagination li {
        display: inline-block;
    }
    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 12px;
        color: #9b59b6;
        background: #292929;
        border: 1px solid #9b59b6;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .pagination li a:hover {
        background-color: #9b59b6;
        color: #fff;
    }
    .pagination li.active span {
        background-color: #9b59b6;
        color: #fff;
        cursor: default;
    }
    .pagination li.disabled span {
        color: #555;
        border-color: #555;
        cursor: not-allowed;
        background: #1c1c1c;
    }
</style>
@endpush
