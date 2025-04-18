@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Sucursales</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" class="row g-3 mb-4 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Buscar por nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre de sucursal..." value="{{ request('nombre') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
                <option value="">-- Todos --</option>
                <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary w-100" type="submit"><i class="fas fa-filter"></i> Filtrar</button>
            <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-undo"></i> Limpiar</a>
        </div>
        <div class="col-md-2 text-end">
            <a href="{{ route('sucursales.create') }}" class="btn btn-success w-100">
                <i class="fas fa-plus"></i> Nueva
            </a>
        </div>
    </form>

    <!-- Exportar -->
    <div class="mb-3 d-flex justify-content-between">
        <div>
            <a href="{{ route('sucursales.export.excel') }}" class="btn btn-outline-success me-2" data-bs-toggle="tooltip" title="Exportar a Excel">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="{{ route('sucursales.export.pdf') }}" class="btn btn-outline-danger" data-bs-toggle="tooltip" title="Exportar a PDF">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Tel. 1</th>
                    <th>Tel. 2</th>
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
                        <td>{{ $sucursal->telefono_1 }}</td>
                        <td>{{ $sucursal->telefono_2 }}</td>
                        <td>{{ $sucursal->celular }}</td>
                        <td>{{ $sucursal->responsable }}</td>
                        <td>{{ $sucursal->email_responsable }}</td>
                        <td class="text-center">
                            <span class="badge rounded-pill bg-{{ $sucursal->status_sucursal === 'activo' ? 'success' : 'secondary' }}">
                                <i class="fas fa-circle {{ $sucursal->status_sucursal === 'activo' ? 'text-light' : 'text-white-50' }}"></i>
                                {{ ucfirst($sucursal->status_sucursal) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('sucursales.edit', $sucursal->id_sucursal) }}"
                               class="btn btn-sm btn-outline-primary me-1"
                               data-bs-toggle="tooltip" title="Editar sucursal">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="confirmarEliminacion('{{ route('sucursales.destroy', $sucursal->id_sucursal) }}')"
                                    data-bs-toggle="tooltip" title="Eliminar sucursal">
                                <i class="fas fa-trash-alt"></i>
                            </button>
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
    <div class="d-flex justify-content-center">
        {{ $sucursales->links() }}
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar esta sucursal? Esta acción no se puede deshacer.
      </div>
      <div class="modal-footer">
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    // Tooltips Bootstrap
    document.addEventListener("DOMContentLoaded", function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });

    // Modal confirmación eliminar
    function confirmarEliminacion(action) {
        const form = document.getElementById('deleteForm');
        form.action = action;
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    }
</script>
@endpush