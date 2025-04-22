@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Crear Nueva Solicitud de Vacaciones</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hay algunos errores con los datos ingresados.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="form-solicitud" action="{{ route('vacaciones.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="fk_num_empleado" class="form-label">Empleado</label>
            <select class="form-select" id="fk_num_empleado" name="fk_num_empleado" required>
                <option value="">-- Selecciona un empleado --</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->num_empleado }}" {{ old('fk_num_empleado') == $empleado->num_empleado ? 'selected' : '' }}>
                        {{ $empleado->nombres }} {{ $empleado->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" class="form-control" id="anio" name="anio" value="{{ old('anio') }}" required>
        </div>

        <div class="mb-3">
            <label for="dias_otorgados" class="form-label">Días Otorgados</label>
            <input type="number" class="form-control" id="dias_otorgados" name="dias_otorgados" value="{{ old('dias_otorgados') }}" required>
        </div>

        <div class="mb-3">
            <label for="dias_disfrutados" class="form-label">Días Disfrutados</label>
            <input type="number" class="form-control" id="dias_disfrutados" name="dias_disfrutados" value="{{ old('dias_disfrutados') }}" required>
        </div>

        <div class="mb-3">
            <label for="saldo" class="form-label">Saldo</label>
            <input type="number" class="form-control" id="saldo" name="saldo" value="{{ old('saldo') }}" required>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" required>{{ old('observaciones') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="estado_solicitud" class="form-label">Estado de la Solicitud</label>
            <select class="form-select" id="estado_solicitud" name="estado_solicitud" required>
                <option value="">-- Selecciona estado --</option>
                <option value="pendiente" {{ old('estado_solicitud') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="aprobada" {{ old('estado_solicitud') == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                <option value="rechazada" {{ old('estado_solicitud') == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_solicitud" class="form-label">Fecha de Solicitud</label>
            <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" value="{{ old('fecha_solicitud', date('Y-m-d')) }}" required>
        </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
            Crear Solicitud
        </button>
    </form>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar creación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas crear esta solicitud de vacaciones?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('form-solicitud').submit();">Sí, crear</button>
            </div>
        </div>
    </div>
</div>
@endsection
