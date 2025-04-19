@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <h2 class="mb-4">Auditorías</h2>

            <form method="GET" action="{{ route('auditorias.index') }}" class="row gy-3 gx-4 mb-4 align-items-end">
                <div class="col-md-4">
                    <label for="empleado" class="form-label">Empleado</label>
                    <select name="empleado_id" id="empleado" class="form-select rounded-3">
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
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control rounded-3" value="{{ request('fecha_inicio') }}">
                </div>
                <div class="col-md-3">
                    <label for="fecha_fin" class="form-label">Hasta</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control rounded-3" value="{{ request('fecha_fin') }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary rounded-3">Filtrar</button>
                </div>
            </form>

            <div class="d-flex justify-content-end mb-3 gap-2">
                <a href="{{ route('auditorias.export', request()->all()) }}" class="btn btn-success rounded-3">
                    <i class="bi bi-file-earmark-excel"></i> Exportar Excel
                </a>
                <a href="{{ route('auditorias.export.pdf', request()->all()) }}" class="btn btn-danger rounded-3">
                    <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle rounded-3 overflow-hidden">
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
                                <td colspan="5" class="text-center text-muted">No se encontraron auditorías.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $auditorias->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection