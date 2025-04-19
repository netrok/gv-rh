@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">📍 Listado de Sucursales</h1>
        <a href="{{ route('sucursales.create') }}" class="btn btn-success shadow">
            <i class="fas fa-plus me-1"></i> Nueva Sucursal
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" class="card p-3 mb-4 shadow-sm">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..." value="{{ request('nombre') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="">-- Estado --</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-5 d-flex gap-2">
                <button class="btn btn-primary w-100">
                    <i class="fas fa-filter me-1"></i> Filtrar
                </button>
                <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-sync-alt me-1"></i> Limpiar
                </a>
            </div>
        </div>
    </form>

    <!-- Exportar -->
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('sucursales.export.excel') }}" class="btn btn-outline-success shadow-sm">
            <i class="fas fa-file-excel me-1"></i> Exportar Excel
        </a>
        <a href="{{ route('sucursales.export.pdf') }}" class="btn btn-outline-danger shadow-sm">
            <i class="fas fa-file-pdf me-1"></i> Exportar PDF
        </a>
    </div>

    <!-- Tabla -->
    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfonos</th>
                    <th>Celular</th>
                    <th>Responsable</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sucursales as $sucursal)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + ($sucursales->currentPage() - 1) * $sucursales->perPage() }}</td>
                        <td>{{ $sucursal->nombre_sucursal }}</td>
                        <td>{{ $sucursal->direccion }}</td>
                        <td>
                            <small class="text-muted">📞 {{ $sucursal->telefono_1 }}</small><br>
                            <small class="text-muted">📞 {{ $sucursal->telefono_2 }}</small>
                        </td>
                        <td>{{ $sucursal->celular }}</td>
                        <td>{{ $sucursal->responsable }}</td>
                        <td>{{ $sucursal->email_responsable }}</td>
                        <td class="text-center">
                            <span class="badge rounded-pill bg-{{ $sucursal->status_sucursal === 'activo' ? 'success' : 'secondary' }}">
                                {{ ucfirst($sucursal->status_sucursal) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('sucursales.edit', $sucursal->id_sucursal) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('sucursales.destroy', $sucursal->id_sucursal) }}" method="POST"
                                  style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta sucursal?')">
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
                        <td colspan="9" class="text-center text-muted">No hay sucursales registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $sucursales->links() }}
    </div>
</div>
@endsection