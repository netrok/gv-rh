@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Reporte de Asistencias por Empleado</h3>

    <form method="GET" action="{{ route('asistencias.reporte') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="empleado_id">Selecciona un empleado:</label>
                <select name="empleado_id" id="empleado_id" class="form-control">
                    <option value="">-- Selecciona --</option>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id_empleado }}" {{ request('empleado_id') == $empleado->id_empleado ? 'selected' : '' }}>
                            {{ $empleado->num_empleado }} - {{ $empleado->nombres }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

    @if(count($asistencias) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Tipo</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_entrada }}</td>
                    <td>{{ $asistencia->hora_salida }}</td>
                    <td>{{ ucfirst($asistencia->tipo) }}</td>
                    <td>{{ $asistencia->observaciones }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request('empleado_id'))
        <p>No hay registros de asistencia para este empleado.</p>
    @endif
</div>
@endsection