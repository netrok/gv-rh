@extends('layouts.app')


@section('content')
    <div class="container">
        <h1 class="mb-4">Listado de Sucursales</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Filtros -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..."
                    value="{{ request('nombre') }}">
            </div>
            <div class="col-md-3">
                <select name="estado" class="form-select">
                    <option value="">-- Estado --</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" type="submit">Filtrar</button>
                <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
            <div class="col-md-2 text-end">
                <a href="{{ route('sucursales.create') }}" class="btn btn-success w-100">
                    <i class="fas fa-plus"></i> Nueva
                </a>
            </div>
        </form>

        <div class="mb-3 d-flex justify-content-between">
            <div>
                <a href="{{ route('sucursales.export.excel') }}" class="btn btn-outline-success me-2">
                    <i class="fas fa-file-excel"></i> Exportar Excel
                </a>
                <a href="{{ route('sucursales.export.pdf') }}" class="btn btn-outline-danger">
                    <i class="fas fa-file-pdf"></i> Exportar PDF
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono 1</th>
                        <th>Teléfono 2</th>
                        <th>Celular</th>
                        <th>Responsable</th>
                        <th>Email Responsable</th>
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
                                    class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('sucursales.destroy', $sucursal->id_sucursal) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta sucursal?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No hay sucursales registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $sucursales->links() }}
        </div>
    </div>
@endsection