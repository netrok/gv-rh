<!-- resources/views/solicitudes_vacaciones/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Solicitudes de Vacaciones</h1>
        <a href="{{ route('solicitudes_vacaciones.create') }}" class="btn btn-primary">Crear Nueva Solicitud</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Año</th>
                    <th>Días Otorgados</th>
                    <th>Días Disfrutados</th>
                    <th>Saldo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->id }}</td>
                        <td>{{ $solicitud->empleado->nombres }} {{ $solicitud->empleado->apellidos }}</td>
                        <td>{{ $solicitud->anio }}</td>
                        <td>{{ $solicitud->dias_otorgados }}</td>
                        <td>{{ $solicitud->dias_disfrutados }}</td>
                        <td>{{ $solicitud->saldo }}</td>
                        <td>{{ $solicitud->estado_solicitud }}</td>
                        <td>
                            <a href="{{ route('solicitudes_vacaciones.edit', $solicitud->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('solicitudes_vacaciones.destroy', $solicitud->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
