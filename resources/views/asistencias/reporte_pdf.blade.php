@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif !important;
        background-color: #f4f4f4 !important;
        color: #333 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .container {
        background-color: white !important;
        padding: 30px !important;
        margin-top: 30px !important;
        border-radius: 10px !important;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    h3 {
        color: #0056b3 !important;
        font-size: 24px !important;
        font-weight: bold !important;
        margin-bottom: 20px !important;
    }

    .form-control {
        font-size: 14px !important;
    }

    .btn-primary {
        background-color: #0056b3 !important;
        border-color: #0056b3 !important;
        font-size: 14px !important;
    }

    .table {
        width: 100% !important;
        margin-top: 30px !important;
        border-collapse: collapse !important;
        border: 1px solid #ddd !important;
    }

    .table th, .table td {
        padding: 12px !important;
        text-align: left !important;
        border-bottom: 1px solid #ddd !important;
    }

    .table th {
        background-color: #0056b3 !important;
        color: white !important;
        font-size: 14px !important;
        text-transform: uppercase !important;
    }

    .table td {
        font-size: 13px !important;
    }

    .watermark {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        font-size: 8rem !important;  /* Ajustar el tamaño de la marca de agua */
        color: rgba(0, 86, 179, 0.1) !important;
        font-weight: bold !important;
        z-index: -1 !important;
        white-space: nowrap !important;
        pointer-events: none !important;
    }

    .container p {
        font-size: 14px !important;
        color: #555 !important;
    }

    .container .no-records {
        text-align: center !important;
        font-size: 16px !important;
        color: #e74c3c !important;
    }
</style>

<div class="container">
    <div class="watermark">Mi Empresa</div>
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
        <p class="no-records">No hay registros de asistencia para este empleado.</p>
    @endif
</div>
@endsection