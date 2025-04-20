@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Listado de Asistencias</h3>
        <a href="{{ route('asistencias.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Asistencia
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm border rounded p-3 bg-white">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Empleado</th>
                    <th>Fecha</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Tipo</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asistencias as $asistencia)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $asistencia->empleado->nombre_completo ?? $asistencia->num_empleado }}</td>
                        <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $asistencia->hora_entrada }}</td>
                        <td>{{ $asistencia->hora_salida }}</td>
                        <td>{{ $asistencia->tipo }}</td>
                        <td>{{ $asistencia->observaciones ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay asistencias registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection