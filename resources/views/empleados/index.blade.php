@extends('layouts.app')

@section('content')

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const forms = document.querySelectorAll('.form-eliminar');

                forms.forEach(form => {
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        const empleadoNombre = form.querySelector('.btn-eliminar').dataset.nombre;

                        Swal.fire({
                            title: `¿Eliminar a ${empleadoNombre}?`,
                            text: "Esta acción no se puede deshacer.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush

    <div class="container">
        <h1 class="mb-4">Listado de Empleados</h1>

        <!-- Filtros -->
        <form action="{{ route('empleados.index') }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre o apellido"
                    value="{{ request('nombre') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Estado --</option>
                    <option value="activo" {{ request('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filtrar
                </button>
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary w-100">
                    <i class="bi bi-x-circle"></i> Limpiar
                </a>
            </div>
        </form>

        <!-- Botones de exportación -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('empleados.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Agregar Empleado
            </a>
            <div>
                <a href="{{ route('empleados.exportExcel') }}" class="btn btn-outline-success me-2">
                    <i class="bi bi-file-earmark-excel"></i> Exportar Excel
                </a>
                <a href="{{ route('empleados.exportarPdf') }}" class="btn btn-danger" target="_blank">Exportar a PDF</a>


            </div>
        </div>

        <!-- Tabla de empleados -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Num. Empleado</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Acciones</th>
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
                                <span class="badge bg-{{ $empleado->status === 'activo' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($empleado->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('empleados.show', $empleado->id_empleado) }}" class="btn btn-sm btn-primary"
                                    title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('empleados.pdf', $empleado->id_empleado) }}"
                                    class="btn btn-sm btn-outline-danger" title="Ver PDF" target="_blank">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>

                                <a href="{{ route('empleados.edit', $empleado->id_empleado) }}" class="btn btn-sm btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST"
                                    class="d-inline form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-eliminar"
                                        data-nombre="{{ $empleado->nombres }} {{ $empleado->apellidos }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No se encontraron empleados.</td>
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