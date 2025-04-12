@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Empleados</h1>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">+ Agregar Empleado</a>

        <div>
            <a href="{{ route('empleados.export', 'excel') }}" class="btn btn-success">Exportar Excel</a>
            <a href="{{ route('empleados.export', 'pdf') }}" class="btn btn-danger">Exportar PDF</a>
        </div>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('empleados.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre..." value="{{ request('busqueda') }}">
            </div>
            <div class="col-md-3">
                <select name="sucursal" class="form-control">
                    <option value="">Todas las sucursales</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}" {{ request('sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>
                            {{ $sucursal->nombre_sucursal }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="estado" class="form-control">
                    <option value="">Todos los estados</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de empleados -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Num. Empleado</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Sucursal</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->num_empleado }}</td>
                    <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->sucursal->nombre_sucursal ?? 'N/A' }}</td>
                    <td>
                        <span class="badge badge-{{ $empleado->status == 'activo' ? 'success' : 'secondary' }}">
                            {{ ucfirst($empleado->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado->id_empleado) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este empleado?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron empleados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $empleados->withQueryString()->links() }}
    </div>
</div>
@endsection
