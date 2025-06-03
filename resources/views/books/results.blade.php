<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Resultados de Búsqueda - BiblioWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
            color: #9b59b6;
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
        .badge.bg-info {
            background-color: #8e44ad !important;
            color: #fff !important;
            font-weight: 600;
        }
        .alert-info {
            background-color: #444;
            color: #ddd;
            border-color: #666;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-search me-2"></i>Resultados de Búsqueda</h1>

        @if(empty($books))
            <div class="alert alert-info text-center mt-4">
                <i class="fas fa-info-circle fa-2x mb-3"></i>
                <h4>No se encontraron libros</h4>
                <p>Intenta con otro término de búsqueda.</p>
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                @foreach($books as $book)
                    <div class="col">
                        <div class="card h-100 book-card">
                            <div class="position-relative">
                                <img src="https://covers.openlibrary.org/b/id/{{ $book['cover_i'] ?? 0 }}-L.jpg"
                                     class="card-img-top" alt="{{ $book['title'] ?? 'Sin título' }}"
                                     style="height: 300px; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $book['title'] ?? 'Sin título' }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $book['author_name'][0] ?? 'Autor desconocido' }}
                                </h6>
                                <p class="card-text">
                                    Año: {{ $book['first_publish_year'] ?? 'N/D' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Edición: {{ $book['edition_count'] ?? '1' }}</small>
                                    <span class="badge bg-info">
                                        {{ $book['language'][0] ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
