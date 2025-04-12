@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Empleados</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('empleados.create') }}" class="btn btn-success">+ Agregar Empleado</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('empleados.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre o apellido" value="{{ request('nombre') }}">
        </div>
        <div class="col-md-3">
            <select name="sucursal" class="form-control">
                <option value="">-- Todas las sucursales --</option>
                @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}" {{ request('sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>
                        {{ $sucursal->nombre_sucursal }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="estado" class="form-control">
                <option value="">-- Todos los estados --</option>
                <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="col-md-2 d-flex">
            <button type="submit" class="btn btn-primary me-2 w-100">Filtrar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary w-100">Limpiar</a>
        </div>
    </form>

    <a href="{{ route('empleados.exportExcel') }}" class="btn btn-success mb-3">Exportar a Excel</a>
    <a href="{{ route('empleados.exportPDF') }}" class="btn btn-danger mb-3">Exportar a PDF</a>



    <!-- Tabla de empleados -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Num. Empleado</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Estado</th>
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
                            <span class="badge bg-{{ $empleado->status == 'activo' ? 'success' : 'secondary' }}">
                                {{ ucfirst($empleado->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('empleados.edit', $empleado->id_empleado) }}" class="btn btn-sm btn-warning">Editar</a>

                            <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este empleado?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No se encontraron empleados con los filtros aplicados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-3">
        {{ $empleados->links() }}
    </div>
</div>
@endsection
