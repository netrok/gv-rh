@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Listado de Puestos</h1>
        <a href="{{ route('puestos.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Nuevo Puesto
        </a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('puestos.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="nombre" value="{{ request('nombre') }}" class="form-control" placeholder="Buscar por nombre">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- Todos los estados --</option>
                <option value="activo" {{ request('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ request('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search"></i> Buscar
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('puestos.index') }}" class="btn btn-outline-secondary w-100">
                <i class="fas fa-undo"></i> Reset
            </a>
        </div>
    </form>

    @if ($puestos->count())
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Puesto</th>
                        <th>Sueldo Base</th>
                        <th>Jefe Directo</th>
                        <th>Status</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($puestos as $puesto)
                        <tr>
                            <td>{{ $puesto->id_puesto }}</td>
                            <td>{{ $puesto->nombre_puesto }}</td>
                            <td>${{ number_format($puesto->sueldo_base, 2) }}</td>
                            <td>{{ $puesto->jefe_directo }}</td>
                            <td>
                                <span class="badge bg-{{ $puesto->status_puesto == 'activo' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($puesto->status_puesto) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('puestos.edit', $puesto->id_puesto) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('puestos.destroy', $puesto->id_puesto) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este puesto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $puestos->appends(request()->query())->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No se encontraron puestos.
        </div>
    @endif
</div>
@endsection