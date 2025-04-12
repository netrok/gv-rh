<!-- resources/views/beneficiarios/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Beneficiario</h1>
        
        <form action="{{ route('beneficiarios.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fk_num_empleado">Empleado</label>
                <select class="form-control" id="fk_num_empleado" name="fk_num_empleado" required>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->num_empleado }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="parentesco">Parentesco</label>
                <input type="text" class="form-control" id="parentesco" name="parentesco" required>
            </div>
            <div class="form-group">
                <label for="porcentaje">Porcentaje</label>
                <input type="number" class="form-control" id="porcentaje" name="porcentaje" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control" id="rfc" name="rfc" required>
            </div>
            <div class="form-group">
                <label for="domicilio">Domicilio</label>
                <textarea class="form-control" id="domicilio" name="domicilio" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Crear Beneficiario</button>
        </form>
    </div>
@endsection
