<!-- resources/views/sucursales/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sucursales</h1>
        <a href="{{ route('sucursales.create') }}" class="btn btn-primary">Crear Nueva Sucursal</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Sucursal</th>
                    <th>Dirección</th>
                    <th>Teléfono 1</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sucursales as $sucursal)
                    <tr>
                        <td>{{ $sucursal->id_sucursal }}</td>
                        <td>{{ $sucursal->nombre_sucursal }}</td>
                        <td>{{ $sucursal->direccion }}</td>
                        <td>{{ $sucursal->telefono_1 }}</td>
                        <td>{{ $sucursal->status_suursal }}</td>
                        <td>
                            <a href="{{ route('sucursales.edit', $sucursal->id_sucursal) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('sucursales.destroy', $sucursal->id_sucursal) }}" method="POST" style="display:inline;">
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
