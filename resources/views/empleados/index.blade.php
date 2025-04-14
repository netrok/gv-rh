@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Listado de Empleados</h1>

        <!-- Filtros -->
        <form action="{{ route('empleados.index') }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o número"
                    value="{{ request('buscar') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Estado --</option>
                    <option value="activo" {{ request('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary w-100">Limpiar</a>
            </div>
        </form>

        <!-- Botones de exportación -->
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('empleados.create') }}" class="btn btn-success">+ Agregar Empleado</a>
            <div>
                <a href="{{ route('empleados.exportExcel') }}" class="btn btn-outline-success me-2">
                    📥 Exportar Excel
                </a>
                <a href="{{ route('empleados.exportPdf') }}" class="btn btn-outline-danger">
                    📄 Exportar PDF
                </a>
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
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
                                <span class="badge bg-{{ $empleado->status == 'activo' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($empleado->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('empleados.show', $empleado->id_empleado) }}" class="btn btn-sm btn-primary"
                                    title="Ver detalles del empleado">
                                    👁️ Mostrar
                                </a>

                                <a href="{{ route('empleados.pdf', $empleado->id_empleado) }}"
                                    class="btn btn-sm btn-outline-danger" target="_blank">📄 Ver PDF</a>

                                <a href="{{ route('empleados.edit', $empleado->id_empleado) }}"
                                    class="btn btn-sm btn-warning">✏️ Editar</a>

                                <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑 Eliminar</button>
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
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $empleados->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection