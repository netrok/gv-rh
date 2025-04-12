<!-- resources/views/empleados/delete.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Eliminar Empleado</h1>
        <p>¿Estás seguro de que deseas eliminar al empleado <strong>{{ $empleado->nombres }} {{ $empleado->apellidos }}</strong>?</p>

        <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
