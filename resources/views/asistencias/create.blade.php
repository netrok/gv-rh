@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Registrar Nueva Asistencia</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups! Hay algunos errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asistencias.store') }}" method="POST">
        @csrf

        {{-- Empleado --}}
        <div class="mb-3">
            <label for="empleado_id" class="form-label">Empleado</label>
            <select name="empleado_id" id="empleado_id" class="form-select" required>
                <option value="">-- Selecciona un empleado --</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id_empleado }}"
                        {{ old('empleado_id') == $empleado->id_empleado ? 'selected' : '' }}>
                        {{ $empleado->nombres }} {{ $empleado->apellidos }} ({{ $empleado->num_empleado }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
        </div>

        {{-- Hora de Entrada --}}
        <div class="mb-3">
            <label for="hora_entrada" class="form-label">Hora de Entrada</label>
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" value="{{ old('hora_entrada') }}" required>
        </div>

        {{-- Hora de Salida --}}
        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora de Salida</label>
            <input type="time" name="hora_salida" id="hora_salida" class="form-control" value="{{ old('hora_salida') }}">
        </div>

        {{-- Tipo --}}
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="">-- Selecciona --</option>
                <option value="Presencial" {{ old('tipo') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                <option value="Remoto" {{ old('tipo') == 'Remoto' ? 'selected' : '' }}>Remoto</option>
                <option value="Mixto" {{ old('tipo') == 'Mixto' ? 'selected' : '' }}>Mixto</option>
            </select>
        </div>

        {{-- Observaciones --}}
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
        <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection