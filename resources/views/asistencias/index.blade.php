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
            {{-- Filtro de búsqueda general --}}
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-5">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control"
                        placeholder="Buscar por nombre o número de empleado">
                </div>
                <div class="col-md-4">
                    <input type="date" name="fecha" value="{{ request('fecha') }}" class="form-control">
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </form>

            {{-- Exportaciones --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                <div class="d-flex gap-2">
                    <a href="{{ route('asistencias.export.excel') }}" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
                    </a>
                    <a href="{{ route('asistencias.export.pdf') }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i> Exportar PDF (Todo)
                    </a>
                </div>

                {{-- Formulario de exportación filtrada a PDF --}}
                <form action="{{ route('asistencias.export.pdf') }}" method="GET" target="_blank" class="d-flex flex-wrap gap-2 align-items-end">
                    <div>
                        <label for="fecha_inicio" class="form-label mb-0 small">Desde:</label>
                        <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio">
                    </div>
                    <div>
                        <label for="fecha_fin" class="form-label mb-0 small">Hasta:</label>
                        <input type="date" name="fecha_fin" class="form-control" id="fecha_fin">
                    </div>
                    <div>
                        <label for="tipo" class="form-label mb-0 small">Tipo:</label>
                        <select name="tipo" class="form-select" id="tipo">
                            <option value="">-- Todos --</option>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                            <option value="falta">Falta</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-file-earmark-pdf"></i> PDF filtrado
                    </button>
                </form>
            </div>

            {{-- Tabla de asistencias --}}
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Núm. Empleado</th>
                        <th>Nombre Completo</th>
                        <th>Fecha</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Tipo</th>
                        <th>Observaciones</th>
                        <th>Reporte</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($asistencias as $asistencia)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $asistencia->empleado->num_empleado ?? 'N/A' }}</td>
                            <td>{{ $asistencia->empleado->nombre_completo ?? 'Empleado eliminado' }}</td>
                            <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $asistencia->hora_entrada ?? '-' }}</td>
                            <td>{{ $asistencia->hora_salida ?? '-' }}</td>
                            <td>{{ ucfirst($asistencia->tipo) }}</td>
                            <td>{{ $asistencia->observaciones ?? '-' }}</td>
                            <td>
                                @if($asistencia->empleado)
                                    <a href="{{ route('asistencias.reporte.pdf', ['empleado' => $asistencia->empleado->id_empleado, 'fecha' => request('fecha')]) }}" 
                                       class="btn btn-sm btn-outline-danger" 
                                       target="_blank">
                                        <i class="bi bi-filetype-pdf"></i> PDF
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No hay asistencias registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    {{ $asistencias->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection