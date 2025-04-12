<!-- resources/views/puestos/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Puestos</h1>
        <a href="{{ route('puestos.create') }}" class="btn btn-primary">Crear Nuevo Puesto</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Puesto</th>
                    <th>Sueldo Base</th>
                    <th>Jefe Directo</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($puestos as $puesto)
                    <tr>
                        <td>{{ $puesto->id_puesto }}</td>
                        <td>{{ $puesto->nombre_puesto }}</td>
                        <td>{{ $puesto->sueldo_base }}</td>
                        <td>{{ $puesto->jefe_directo }}</td>
                        <td>{{ $puesto->status_puesto }}</td>
                        <td>
                            <a href="{{ route('puestos.edit', $puesto->id_puesto) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('puestos.destroy', $puesto->id_puesto) }}" method="POST" style="display:inline;">
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
