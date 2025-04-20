@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">👥 Listado de Empleados</h2>
        <a href="{{ route('empleados.create') }}" class="btn btn-success shadow">
            <i class="bi bi-plus-circle me-1"></i> Agregar Empleado
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form action="{{ route('empleados.index') }}" method="GET" class="card p-3 mb-4 shadow-sm">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Nombre o Apellido</label>
                <input type="text" name="nombre" class="form-control" placeholder="Buscar..." value="{{ request('nombre') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Estado</label>
                <select name="status" class="form-select">
                    <option value="">-- Estado --</option>
                    <option value="activo" {{ request('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-5 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel-fill"></i> Filtrar
                </button>
                <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-circle-fill"></i> Limpiar
                </a>
            </div>
        </div>
    </form>

    <!-- Exportar -->
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('empleados.exportExcel') }}" class="btn btn-outline-success shadow-sm">
            <i class="bi bi-file-earmark-excel"></i> Exportar Excel
        </a>
        <a href="{{ route('empleados.exportarPdf') }}" class="btn btn-outline-danger shadow-sm" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
        </a>
    </div>

    <!-- Tabla -->
    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Num. Empleado</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->num_empleado }}</td>
                        <td>{{ $empleado->nombres }}</td>
                        <td>{{ $empleado->apellidos }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $empleado->status === 'activo' ? 'success' : 'secondary' }}">
                                {{ ucfirst($empleado->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('empleados.show', $empleado->id_empleado) }}" class="btn btn-sm btn-outline-primary me-1" title="Ver detalles">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('empleados.pdf', $empleado->id_empleado) }}" class="btn btn-sm btn-outline-danger me-1" title="Ver PDF" target="_blank">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </a>
                            <a href="{{ route('empleados.edit', $empleado->id_empleado) }}" class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST" class="d-inline form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-eliminar" data-nombre="{{ $empleado->nombres }} {{ $empleado->apellidos }}" title="Eliminar">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación con texto adicional -->
    @if ($empleados->total() > 0)
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Mostrando <strong>{{ $empleados->firstItem() }}</strong> a <strong>{{ $empleados->lastItem() }}</strong> de <strong>{{ $empleados->total() }}</strong> resultados
            </div>
            <div>
                {{ $empleados->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection