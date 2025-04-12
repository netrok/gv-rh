<!-- resources/views/beneficiarios/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Beneficiario</h1>
        
        <form action="{{ route('beneficiarios.update', $beneficiario->id_beneficiario) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="fk_num_empleado">Empleado</label>
                <select class="form-control" id="fk_num_empleado" name="fk_num_empleado" required>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->num_empleado }}" {{ $beneficiario->fk_num_empleado == $empleado->num_empleado ? 'selected' : '' }}>
                            {{ $empleado->nombres }} {{ $empleado->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $beneficiario->nombres }}" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $beneficiario->apellidos }}" required>
            </div>
            <div class="form-group">
                <label for="parentesco">Parentesco</label>
                <input type="text" class="form-control" id="parentesco" name="parentesco" value="{{ $beneficiario->parentesco }}" required>
            </div>
            <div class="form-group">
                <label for="porcentaje">Porcentaje</label>
                <input type="number" class="form-control" id="porcentaje" name="porcentaje" value="{{ $beneficiario->porcentaje }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $beneficiario->rfc }}" required>
            </div>
            <div class="form-group">
                <label for="domicilio">Domicilio</label>
                <textarea class="form-control" id="domicilio" name="domicilio" required>{{ $beneficiario->domicilio }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Beneficiario</button>
        </form>
    </div>
@endsection
