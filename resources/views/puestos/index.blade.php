@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">💼 Listado de Puestos</h1>
        <a href="{{ route('puestos.create') }}" class="btn btn-success shadow">
            <i class="fas fa-plus me-1"></i> Nuevo Puesto
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" class="card p-3 mb-4 shadow-sm">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Nombre del Puesto</label>
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..." value="{{ request('nombre') }}">
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
                <button class="btn btn-primary w-100">
                    <i class="fas fa-filter me-1"></i> Filtrar
                </button>
                <a href="{{ route('puestos.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-sync-alt me-1"></i> Limpiar
                </a>
            </div>
        </div>
    </form>

    <!-- Tabla -->
    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nombre del Puesto</th>
                    <th>Sueldo Base</th>
                    <th>Jefe Directo</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($puestos as $puesto)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + ($puestos->currentPage() - 1) * $puestos->perPage() }}</td>
                        <td>{{ $puesto->nombre_puesto }}</td>
                        <td>${{ number_format($puesto->sueldo_base, 2) }}</td>
                        <td>{{ $puesto->jefe_directo }}</td>
                        <td class="text-center">
                            <span class="badge rounded-pill bg-{{ $puesto->status_puesto === 'activo' ? 'success' : 'secondary' }}">
                                {{ ucfirst($puesto->status_puesto) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('puestos.edit', $puesto->id_puesto) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('puestos.destroy', $puesto->id_puesto) }}" method="POST"
                                  style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este puesto?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay puestos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $puestos->links() }}
    </div>
</div>
@endsection