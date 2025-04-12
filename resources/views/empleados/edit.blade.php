@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Empleado</h2>

    <form action="{{ route('empleados.update', $empleado->id_empleado) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Campos de texto (Nombre, Apellidos, etc) -->
        @php
            $campos = [
                'num_empleado' => 'Número de Empleado',
                'nombres' => 'Nombres',
                'apellidos' => 'Apellidos',
                'domicilio' => 'Domicilio',
                'fecha_nacimiento' => 'Fecha de Nacimiento',
                'email' => 'Correo Electrónico',
                'telefono' => 'Teléfono',
                'celular' => 'Celular',
                'ine' => 'INE',
                'curp' => 'CURP',
                'nss' => 'NSS',
                'infonavit' => 'Infonavit',
                'fecha_contratacion' => 'Fecha de Contratación',
            ];
        @endphp

        @foreach ($campos as $name => $label)
            <div class="form-group">
                <label for="{{ $name }}">{{ $label }}</label>
                <input
                    type="{{ str_contains($name, 'fecha') ? 'date' : (str_contains($name, 'email') ? 'email' : 'text') }}"
                    name="{{ $name }}"
                    class="form-control @error($name) is-invalid @enderror"
                    value="{{ old($name, $empleado->$name) }}">
                @error($name)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <!-- Puesto -->
        <div class="form-group">
            <label for="fk_id_puesto">Puesto</label>
            <select name="fk_id_puesto" id="fk_id_puesto" class="form-control @error('fk_id_puesto') is-invalid @enderror">
                <option value="">Selecciona un puesto</option>
                @foreach ($puestos as $puesto)
                    <option value="{{ $puesto->id_puesto }}"
                        {{ old('fk_id_puesto', $empleado->fk_id_puesto) == $puesto->id_puesto ? 'selected' : '' }}>
                        {{ $puesto->nombre_puesto }}
                    </option>
                @endforeach
            </select>
            @error('fk_id_puesto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Sucursal -->
        <div class="form-group">
            <label for="fk_id_sucursal">Sucursal</label>
            <select name="fk_id_sucursal" id="fk_id_sucursal" class="form-control @error('fk_id_sucursal') is-invalid @enderror">
                <option value="">Selecciona una sucursal</option>
                @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}"
                        {{ old('fk_id_sucursal', $empleado->fk_id_sucursal) == $sucursal->id_sucursal ? 'selected' : '' }}>
                        {{ $sucursal->nombre_sucursal }}
                    </option>
                @endforeach
            </select>
            @error('fk_id_sucursal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Estado -->
        <div class="form-group">
            <label for="status">Estado</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror">
                <option value="activo" {{ old('status', $empleado->status) == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('status', $empleado->status) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Imagen -->
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" class="form-control-file @error('imagen') is-invalid @enderror">
            @error('imagen')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            @if ($empleado->imagen)
                <div class="mt-2">
                    <img src="{{ Storage::url($empleado->imagen) }}" alt="Imagen actual" width="100">
                </div>
            @endif
        </div>

        <!-- Botones -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">← Regresar</a>
        </div>
    </form>
</div>
@endsection
