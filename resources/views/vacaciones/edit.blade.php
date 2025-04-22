@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar Solicitud de Vacaciones</h1>

        <form action="{{ route('vacaciones.update', $vacacion->id) }}" method="POST" id="form-vacacion">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <strong>Detalles de la Solicitud</strong>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="empleado" class="form-label">Empleado</label>
                        <input type="text" class="form-control" id="empleado" value="{{ $vacacion->empleado->nombres }} {{ $vacacion->empleado->apellidos }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="anio" class="form-label">Año</label>
                        <input type="number" class="form-control" id="anio" name="anio" value="{{ $vacacion->anio }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="dias_otorgados" class="form-label">Días Otorgados</label>
                        <input type="number" class="form-control" id="dias_otorgados" name="dias_otorgados" value="{{ $vacacion->dias_otorgados }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="dias_disfrutados" class="form-label">Días Disfrutados</label>
                        <input type="number" class="form-control" id="dias_disfrutados" name="dias_disfrutados" value="{{ $vacacion->dias_disfrutados }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="saldo" class="form-label">Saldo</label>
                        <input type="number" class="form-control" id="saldo" name="saldo" value="{{ $vacacion->saldo }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{ $vacacion->observaciones }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="estado_solicitud" class="form-label">Estado de la Solicitud</label>
                        <select class="form-select" id="estado_solicitud" name="estado_solicitud" required>
                            <option value="Pendiente" {{ $vacacion->estado_solicitud == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Aprobado" {{ $vacacion->estado_solicitud == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                            <option value="Rechazado" {{ $vacacion->estado_solicitud == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_solicitud" class="form-label">Fecha de Solicitud</label>
                        <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" value="{{ $vacacion->fecha_solicitud }}" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('vacaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                <!-- Botón sin submit para que no se envíe el formulario directamente -->
                <button type="button" class="btn btn-primary" id="guardarBtn">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmarModal" tabindex="-1" aria-labelledby="confirmarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel">Confirmar Actualización</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas guardar los cambios?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Botón que confirma el envío del formulario -->
                    <button type="button" id="confirmarBtn" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Mostrar el modal al hacer clic en "Guardar Cambios"
            document.getElementById('guardarBtn').addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir el envío del formulario
                var modal = new bootstrap.Modal(document.getElementById('confirmarModal'));
                modal.show(); // Mostrar el modal
            });

            // Enviar el formulario cuando se confirme
            document.getElementById('confirmarBtn').addEventListener('click', function() {
                document.getElementById('form-vacacion').submit(); // Enviar el formulario
            });
        </script>
    @endpush
@endsection
