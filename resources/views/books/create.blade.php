<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Libro - BiblioWeb</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #1c1c1c;
            color: #eee;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .container {
            max-width: 600px;
            background: #292929;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(155, 89, 182, 0.6);
        }
        h1 {
            color: #9b59b6;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            text-shadow: 1px 1px 4px #5e3370;
        }
        label {
            font-weight: 600;
            color: #ccc;
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
        .btn-primary {
            background-color: #9b59b6;
            border-color: #9b59b6;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #7f3996;
            border-color: #7f3996;
        }
        .text-muted {
            color: #777 !important;
        }
        .form-text {
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-plus-circle me-2"></i>Crear Nuevo Libro</h1>

<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título *</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Ingrese el título del libro" required />
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Autor *</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Nombre del autor" required />
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Breve descripción del libro"></textarea>
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN *</label>
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN del libro" required />
                <div class="form-text">Ejemplo: 978-3-16-148410-0</div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoría *</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                    <option value="Ficción">Ficción</option>
                    <option value="No ficción">No ficción</option>
                    <option value="Ciencia">Ciencia</option>
                    <option value="Historia">Historia</option>
                    <option value="Biografía">Biografía</option>
                    <option value="Tecnología">Tecnología</option>
                    <!-- Agrega más categorías según tu necesidad -->
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Estado *</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="" selected disabled>Seleccione el estado</option>
                    <option value="disponible">Disponible</option>
                    <option value="prestado">Prestado</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="cover_image" class="form-label">Portada (imagen)</label>
                <input class="form-control" type="file" id="cover_image" name="cover_image" accept="image/*" />
                <div class="form-text">Opcional. Formatos permitidos: jpg, png, gif.</div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i> Guardar Libro
                </button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
