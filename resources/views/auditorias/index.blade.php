@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Auditorías</h1>

    <form method="GET" action="{{ route('auditorias.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="empleado" class="form-label">Empleado</label>
            <select name="empleado_id" id="empleado" class="form-select">
                <option value="">-- Todos --</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id_empleado }}" {{ request('empleado_id') == $empleado->id_empleado ? 'selected' : '' }}>
                        {{ $empleado->nombres }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="fecha_inicio" class="form-label">Desde</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
        </div>
        <div class="col-md-3">
            <label for="fecha_fin" class="form-label">Hasta</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <div class="mb-3 d-flex justify-content-end gap-2">
        <a href="{{ route('auditorias.export', request()->all()) }}" class="btn btn-success">Exportar Excel</a>
        <a href="{{ route('auditorias.export.pdf', request()->all()) }}" class="btn btn-danger">Exportar PDF</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Empleado</th>
                    <th>Acción</th>
                    <th>Cambios</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($auditorias as $index => $a)
                    <tr>
                        <td>{{ $auditorias->firstItem() + $index }}</td>
                        <td>{{ $a->empleado->nombres ?? 'Empleado eliminado' }}</td>
                        <td><span class="badge bg-info text-dark">{{ ucfirst($a->accion) }}</span></td>
                        <td>
                            @php
                                $cambios = is_string($a->changed_data) ? json_decode($a->changed_data, true) : $a->changed_data;
                            @endphp
                            @if(is_array($cambios))
                                @foreach ($cambios as $campo => $valores)
                                    <strong>{{ $campo }}:</strong>
                                    <span class="text-danger">{{ $valores['old'] ?? '-' }}</span>
                                    →
                                    <span class="text-success">{{ $valores['new'] ?? '-' }}</span><br>
                                @endforeach
                            @else
                                <em>Sin cambios registrados</em>
                            @endif
                        </td>
                        <td>{{ $a->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron auditorías.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $auditorias->withQueryString()->links() }}
    </div>
</div>
@endsection