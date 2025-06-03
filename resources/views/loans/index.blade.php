@extends('layouts.app')

@section('title', 'Préstamos - BiblioWeb')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <h1 class="mb-4" style="color: #9b59b6; font-weight: 700; text-shadow: 1px 1px 4px #5e3370;">
        <i class="fas fa-book-reader me-2"></i>Préstamos Registrados
    </h1>
    <a href="{{ route('loans.export.pdf') }}" class="btn btn-outline-danger">
    <i class="fas fa-file-pdf"></i> Exportar PDF
</a>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($loans->isEmpty())
        <div class="alert alert-info text-center" style="background-color: #444; color: #ddd; border-color: #666; border-radius: 12px;">
            <i class="fas fa-info-circle fa-2x mb-3"></i>
            <h4>No hay préstamos registrados.</h4>
            <p>Aún no se han registrado préstamos en la biblioteca.</p>
        </div>
    @else
        <table class="table table-dark table-striped table-hover" style="border-radius: 12px; overflow: hidden;">
            <thead style="background-color: #9b59b6;">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Fecha préstamo</th>
                    <th>Fecha devolución</th>
                    <th>Devuelto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->user->name }}</td>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                        <td>{{ $loan->return_date ? $loan->return_date->format('d/m/Y') : '-' }}</td>
                        <td>
                            @if($loan->returned_at)
                                <span class="badge bg-success">Sí ({{ $loan->returned_at->format('d/m/Y') }})</span>
                            @else
                                <span class="badge bg-warning text-dark">No</span>
                            @endif
                        </td>
                        <td>
                            @if(!$loan->returned_at)
    <form action="{{ route('loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Confirmar devolución del libro?');" style="display:inline-block;">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-success" title="Marcar como devuelto">
            <i class="fas fa-undo-alt"></i> Devolver
        </button>
        
    </form>
@else
    <button class="btn btn-sm btn-outline-secondary" disabled title="Ya devuelto">
        <i class="fas fa-check"></i> Devuelto
    </button>
@endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 d-flex justify-content-center">
            {{ $loans->links() }}
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    body {
        background: #1c1c1c;
        color: #eee;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .table-dark {
        background-color: #292929;
    }
    .table thead th {
        border-bottom: 2px solid #9b59b6;
    }
    .btn-outline-success:hover {
        background-color: #27ae60;
        color: white;
        border-color: #27ae60;
    }
</style>
@endpush
