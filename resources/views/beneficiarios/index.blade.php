<!-- resources/views/beneficiarios/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Beneficiarios</h1>
        <a href="{{ route('beneficiarios.create') }}" class="btn btn-primary">Crear Nuevo Beneficiario</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Nombre</th>
                    <th>Parentesco</th>
                    <th>Porcentaje</th>
                    <th>RFC</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beneficiarios as $beneficiario)
                    <tr>
                        <td>{{ $beneficiario->id_beneficiario }}</td>
                        <td>{{ $beneficiario->empleado->nombres }} {{ $beneficiario->empleado->apellidos }}</td>
                        <td>{{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</td>
                        <td>{{ $beneficiario->parentesco }}</td>
                        <td>{{ $beneficiario->porcentaje }}%</td>
                        <td>{{ $beneficiario->rfc }}</td>
                        <td>
                            <a href="{{ route('beneficiarios.edit', $beneficiario->id_beneficiario) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('beneficiarios.destroy', $beneficiario->id_beneficiario) }}" method="POST" style="display:inline;">
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
