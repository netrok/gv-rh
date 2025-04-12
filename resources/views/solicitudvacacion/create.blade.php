<!-- resources/views/solicitudes_vacaciones/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nueva Solicitud de Vacaciones</h1>

        <form action="{{ route('solicitudes_vacaciones.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fk_num_empleado">Empleado</label>
                <select class="form-control" id="fk_num_empleado" name="fk_num_empleado" required>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->num_empleado }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="anio">Año</label>
                <input type="number" class="form-control" id="anio" name="anio" required>
            </div>
            <div class="form-group">
                <label for="dias_otorgados">Días Otorgados</label>
                <input type="number" class="form-control" id="dias_otorgados" name="dias_otorgados" required>
            </div>
            <div class="form-group">
                <label for="dias_disfrutados">Días Disfrutados</label>
                <input type="number" class="form-control" id="dias_disfrutados" name="dias_disfrutados" required>
            </div>
            <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="number" class="form-control" id="saldo" name="saldo" required>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" required></textarea>
            </div>
            <div class="form-group">
                <label for="estado_solicitud">Estado de la Solicitud</label>
                <select class="form-control" id="estado_solicitud" name="estado_solicitud" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="aprobada">Aprobada</option>
                    <option value="rechazada">Rechazada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Solicitud</button>
        </form>
    </div>
@endsection
