@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 text-primary">Registros de Vacaciones</h3>
                <a href="{{ route('vacaciones.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Crear Nuevo Registro
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Empleado</th>
                            <th>Año</th>
                            <th>Días Otorgados</th>
                            <th>Días Disfrutados</th>
                            <th>Saldo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacaciones as $vacacion)
                            <tr>
                                <td>{{ $vacacion->id }}</td>
                                <td>{{ $vacacion->empleado->nombres ?? 'N/A' }} {{ $vacacion->empleado->apellidos ?? '' }}</td>
                                <td>{{ $vacacion->anio }}</td>
                                <td>{{ $vacacion->dias_otorgados }}</td>
                                <td>{{ $vacacion->dias_disfrutados }}</td>
                                <td>{{ $vacacion->saldo }}</td>
                                <td>
                                    <span class="badge bg-{{ $vacacion->estado_solicitud === 'Aprobado' ? 'success' : ($vacacion->estado_solicitud === 'Pendiente' ? 'warning text-dark' : 'secondary') }}">
                                        {{ $vacacion->estado_solicitud }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('vacaciones.edit', $vacacion->id) }}" class="btn btn-outline-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('vacaciones.destroy', $vacacion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($vacaciones->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-muted">No hay registros disponibles.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
