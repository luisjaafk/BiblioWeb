@extends('layouts.app')

@section('title', 'Crear Préstamo')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 style="color: #9b59b6; font-weight: 700; text-shadow: 1px 1px 4px #5e3370;">
                <i class="fas fa-book-reader me-2"></i>Crear nuevo préstamo
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('loans.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver a préstamos
            </a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger rounded-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @auth
    <form action="{{ route('loans.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-12">
            <label for="user_id" class="form-label fw-bold">Usuario</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="" disabled selected>Selecciona un usuario</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12">
            <label for="book_id" class="form-label fw-bold">Libro</label>
            <select name="book_id" id="book_id" class="form-select" required>
                <option value="" disabled selected>Selecciona un libro disponible</option>
                @foreach ($books as $book)
                    @if ($book->status === 'disponible')
                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }} - {{ $book->author }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-md-12">
            <label for="return_date" class="form-label fw-bold">Fecha de devolución (opcional)</label>
            <input type="date" name="return_date" id="return_date" class="form-control" value="{{ old('return_date') }}">
        </div>

        <div class="col-md-12 d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Registrar préstamo
            </button>
        </div>
    </form>
    @else
    <div class="alert alert-warning">
        Debes <a href="{{ route('login') }}">iniciar sesión</a> para poder crear un préstamo.
    </div>
    @endauth
</div>
@endsection
