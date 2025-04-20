@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Registrar Asistencia</h2>

        <!-- Mostrar el mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('asistencias.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="num_empleado">Empleado</label>
                <select class="form-control" name="num_empleado" required>
                    <option value="">Selecciona un empleado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->num_empleado }}">{{ $empleado->num_empleado }} - {{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="hora_entrada">Hora de Entrada</label>
                <input type="time" class="form-control" name="hora_entrada" required>
            </div>

            <div class="form-group">
                <label for="hora_salida">Hora de Salida</label>
                <input type="time" class="form-control" name="hora_salida" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de Asistencia</label>
                <select class="form-control" name="tipo" required>
                    <option value="Jornada Completa">Jornada Completa</option>
                    <option value="Medio Día">Medio Día</option>
                    <option value="Ausente">Ausente</option>
                </select>
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" name="observaciones" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
        </form>
    </div>
@endsection