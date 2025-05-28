<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Catálogo - BiblioWeb</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background: #1c1c1c;
            color: #eee;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        h1 {
            color: #9b59b6; /* morado */
            font-weight: 700;
            text-shadow: 1px 1px 4px #5e3370;
        }
        .book-card {
            background: #292929;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(155, 89, 182, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(155, 89, 182, 0.7);
        }
        .card-body h5, .card-body h6 {
            color: #ddd;
        }
        .card-body p {
            color: #bbb;
        }
        .availability-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25em 0.6em;
            border-radius: 15px;
            opacity: 0.85;
        }
        .bg-success {
            background-color: #27ae60 !important;
        }
        .bg-danger {
            background-color: #c0392b !important;
        }
        .badge.bg-info {
            background-color: #8e44ad !important;
            color: #fff !important;
            font-weight: 600;
        }
        .btn-outline-primary {
            color: #9b59b6;
            border-color: #9b59b6;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-outline-primary:hover {
            background-color: #9b59b6;
            color: #fff;
        }
        .btn-outline-secondary {
            color: #7f8c8d;
            border-color: #7f8c8d;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-outline-secondary:hover {
            background-color: #7f8c8d;
            color: #fff;
        }
        .btn-outline-danger {
            color: #e74c3c;
            border-color: #e74c3c;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-outline-danger:hover {
            background-color: #e74c3c;
            color: #fff;
        }
        .alert-info {
            background-color: #444;
            color: #ddd;
            border-color: #666;
            border-radius: 12px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h1><i class="fas fa-book-open me-2"></i>Catálogo de Libros</h1>
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
                    <option value="" {{ request('status') === null ? 'selected' : '' }}>Estado: Todos</option>
                    <option value="disponible" {{ request('status') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="prestado" {{ request('status') === 'prestado' ? 'selected' : '' }}>Prestado</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <div id="books-container" class="row row-cols-1 row-cols-md-3 g-4">
            @if($books->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info text-center">
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
                        <div class="card h-100 book-card">
                            <div class="position-relative">
                                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://via.placeholder.com/300x450.png?text=Portada+no+disponible' }}"
                                     class="card-img-top" alt="{{ $book->title }}" style="height: 300px; object-fit: cover;">
                                <span class="position-absolute top-0 end-0 m-2 badge {{ $book->status === 'disponible' ? 'bg-success' : 'bg-danger' }} availability-badge">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
                                <p class="card-text text-truncate">{{ $book->description ?? 'Descripción no disponible' }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">ISBN: {{ $book->isbn }}</small>
                                    <span class="badge bg-info">{{ $book->category }}</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> Detalles
                                    </a>
                                    <div>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este libro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
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
            {{ $books->withQueryString()->links() }}
        </div>
    </div>

    <!-- Bootstrap JS (Popper + Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
