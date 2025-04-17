@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Beneficiario</h1>

    <form action="{{ route('beneficiarios.update', $beneficiario->id_beneficiario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="fk_num_empleado">Empleado</label>
            <select class="form-control" id="fk_num_empleado" name="fk_num_empleado" required>
                <option value="">-- Selecciona un empleado --</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->num_empleado }}"
                        {{ $beneficiario->fk_num_empleado == $empleado->num_empleado ? 'selected' : '' }}>
                        {{ $empleado->nombres }} {{ $empleado->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres"
                   value="{{ old('nombres', $beneficiario->nombres) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos"
                   value="{{ old('apellidos', $beneficiario->apellidos) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="parentesco">Parentesco</label>
            <input type="text" class="form-control" id="parentesco" name="parentesco"
                   value="{{ old('parentesco', $beneficiario->parentesco) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="porcentaje">Porcentaje</label>
            <input type="number" step="0.01" class="form-control" id="porcentaje" name="porcentaje"
                   value="{{ old('porcentaje', $beneficiario->porcentaje) }}" required>
        </div>

        <div class="form-group mb-4">
            <label for="rfc">RFC</label>
            <input type="text" class="form-control" id="rfc" name="rfc"
                   value="{{ old('rfc', $beneficiario->rfc) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('beneficiarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection