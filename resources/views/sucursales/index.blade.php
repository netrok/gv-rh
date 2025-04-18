@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">📍 Sucursales</h1>
        <a href="{{ route('sucursales.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Sucursal
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Buscar por nombre</label>
                    <input type="text" name="nombre" class="form-control"
                        value="{{ request('nombre') }}" placeholder="Ej: Centro, Norte, etc.">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">-- Todos --</option>
                        <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-5 d-flex gap-2">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Limpiar
                    </a>
                    <a href="{{ route('sucursales.export.excel') }}" class="btn btn-outline-success">
                        <i class="fas fa-file-excel"></i> Excel
                    </a>
                    <a href="{{ route('sucursales.export.pdf') }}" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono 1</th>
                    <th>Teléfono 2</th>
                    <th>Celular</th>
                    <th>Responsable</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sucursales as $sucursal)
                    <tr>
                        <td>{{ $loop->iteration + ($sucursales->currentPage() - 1) * $sucursales->perPage() }}</td>
                        <td>{{ $sucursal->nombre_sucursal }}</td>
                        <td>{{ $sucursal->direccion }}</td>
                        <td>{{ $sucursal->telefono_1 }}</td>
                        <td>{{ $sucursal->telefono_2 }}</td>
                        <td>{{ $sucursal->celular }}</td>
                        <td>{{ $sucursal->responsable }}</td>
                        <td>{{ $sucursal->email_responsable }}</td>
                        <td>
                            <span class="badge bg-{{ $sucursal->status_sucursal === 'activo' ? 'success' : 'secondary' }}">
                                {{ ucfirst($sucursal->status_sucursal) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('sucursales.edit', $sucursal->id_sucursal) }}"
                                class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('sucursales.destroy', $sucursal->id_sucursal) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta sucursal?')">
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
                        <td colspan="10" class="text-center text-muted">No hay sucursales registradas.</td>
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