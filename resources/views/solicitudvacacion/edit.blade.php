<!-- resources/views/solicitudes_vacaciones/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Solicitud de Vacaciones</h1>

        <form action="{{ route('solicitudes_vacaciones.update', $solicitud->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="fk_num_empleado">Empleado</label>
                <select class="form-control" id="fk_num_empleado" name="fk_num_empleado" required>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->num_empleado }}" {{ $solicitud->fk_num_empleado == $empleado->num_empleado ? 'selected' : '' }}>
                            {{ $empleado->nombres }} {{ $empleado->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="anio">Año</label>
                <input type="number" class="form-control" id="anio" name="anio" value="{{ $solicitud->anio }}" required>
            </div>
            <div class="form-group">
                <label for="dias_otorgados">Días Otorgados</label>
                <input type="number" class="form-control" id="dias_otorgados" name="dias_otorgados" value="{{ $solicitud->dias_otorgados }}" required>
            </div>
            <div class="form-group">
                <label for="dias_disfrutados">Días Disfrutados</label>
                <input type="number" class="form-control" id="dias_disfrutados" name="dias_disfrutados" value="{{ $solicitud->dias_disfrutados }}" required>
            </div>
            <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="number" class="form-control" id="saldo" name="saldo" value="{{ $solicitud->saldo }}" required>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" required>{{ $solicitud->observaciones }}</textarea>
            </div>
            <div class="form-group">
                <label for="estado_solicitud">Estado de la Solicitud</label>
                <select class="form-control" id="estado_solicitud" name="estado_solicitud" required>
                    <option value="pendiente" {{ $solicitud->estado_solicitud == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="aprobada" {{ $solicitud->estado_solicitud == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                    <option value="rechazada" {{ $solicitud->estado_solicitud == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary
