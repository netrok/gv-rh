@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Listado de Beneficiarios</h1>
        <a href="{{ route('beneficiarios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Beneficiario
        </a>
    </div>

    {{-- Alerta de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    {{-- Filtros --}}
    <form action="{{ route('beneficiarios.index') }}" method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre"
                    value="{{ request('nombre') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="rfc" class="form-control" placeholder="Buscar por RFC"
                    value="{{ request('rfc') }}">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-search"></i> Buscar
                </button>
                <a href="{{ route('beneficiarios.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Limpiar
                </a>
            </div>
        </div>
    </form>

    {{-- Tabla --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Empleado</th>
                            <th>Nombre</th>
                            <th>Parentesco</th>
                            <th>Porcentaje</th>
                            <th>RFC</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beneficiarios as $beneficiario)
                            <tr>
                                <td>{{ $beneficiario->id_beneficiario }}</td>
                                <td>
                                    @if($beneficiario->empleado)
                                        {{ $beneficiario->empleado->nombres }} {{ $beneficiario->empleado->apellidos }}
                                    @else
                                        <span class="text-muted fst-italic">Sin asignar</span>
                                    @endif
                                </td>
                                <td>{{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</td>
                                <td>{{ $beneficiario->parentesco }}</td>
                                <td>{{ $beneficiario->porcentaje }}%</td>
                                <td>{{ $beneficiario->rfc }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                        <a href="{{ route('beneficiarios.edit', $beneficiario->id_beneficiario) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="{{ route('beneficiarios.generarPdf', $beneficiario->id_beneficiario) }}" target="_blank" class="btn btn-success btn-sm">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </a>
                                        <form action="{{ route('beneficiarios.destroy', $beneficiario->id_beneficiario) }}" method="POST" onsubmit="return confirm('¿Eliminar este beneficiario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle"></i> No hay beneficiarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $beneficiarios->appends(request()->query())->links() }}
    </div>
</div>
@endsection