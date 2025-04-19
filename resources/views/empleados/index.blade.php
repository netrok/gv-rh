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

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Listado de Empleados</h2>
        <a href="{{ route('empleados.create') }}" class="btn btn-success shadow">
            <i class="bi bi-plus-circle me-1"></i> Agregar Empleado
        </a>
    </div>

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
        <div class="col-md-5 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-funnel-fill"></i> Filtrar
            </button>
            <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle-fill"></i> Limpiar
            </a>
        </div>
    </form>

    <!-- Botones de exportación -->
    <div class="d-flex justify-content-end mb-3 gap-2">
        <a href="{{ route('empleados.exportExcel') }}" class="btn btn-outline-success">
            <i class="bi bi-file-earmark-excel"></i> Exportar Excel
        </a>
        <a href="{{ route('empleados.exportarPdf') }}" class="btn btn-outline-danger" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
        </a>
    </div>

    <!-- Tabla de empleados -->
    <div class="table-responsive rounded shadow-sm">
        <table class="table table-hover align-middle text-center table-bordered">
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
                        <span class="badge bg-{{ $empleado->status === 'activo' ? 'success' : 'secondary' }}">
                            {{ ucfirst($empleado->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('empleados.show', $empleado->id_empleado) }}" class="btn btn-sm btn-outline-primary"
                            title="Ver detalles">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        <a href="{{ route('empleados.pdf', $empleado->id_empleado) }}" class="btn btn-sm btn-outline-danger"
                            title="Ver PDF" target="_blank">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </a>

                        <a href="{{ route('empleados.edit', $empleado->id_empleado) }}" class="btn btn-sm btn-outline-warning"
                            title="Editar">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST"
                            class="d-inline form-eliminar">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-eliminar"
                                data-nombre="{{ $empleado->nombres }} {{ $empleado->apellidos }}" title="Eliminar">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No se encontraron empleados.</td>
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