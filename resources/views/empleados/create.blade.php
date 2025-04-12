@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Empleado</h2>
    <form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Número de Empleado -->
        <div class="form-group mb-3">
            <label for="num_empleado">Número de Empleado</label>
            <input type="text" name="num_empleado" class="form-control @error('num_empleado') is-invalid @enderror" value="{{ old('num_empleado') }}" required>
            @error('num_empleado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nombres -->
        <div class="form-group mb-3">
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres') }}" required>
            @error('nombres')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Apellidos -->
        <div class="form-group mb-3">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" required>
            @error('apellidos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Domicilio -->
        <div class="form-group mb-3">
            <label for="domicilio">Domicilio</label>
            <input type="text" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" value="{{ old('domicilio') }}" required>
            @error('domicilio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="form-group mb-3">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" required>
            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Correo Electrónico -->
        <div class="form-group mb-3">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Teléfono -->
        <div class="form-group mb-3">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" pattern="\d{10}" maxlength="10">
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Celular -->
        <div class="form-group mb-3">
            <label for="celular">Celular</label>
            <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular') }}" pattern="\d{10}" maxlength="10">
            @error('celular')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- INE -->
        <div class="form-group mb-3">
            <label for="ine">INE</label>
            <input type="text" name="ine" class="form-control @error('ine') is-invalid @enderror" value="{{ old('ine') }}" required>
            @error('ine')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- CURP -->
        <div class="form-group mb-3">
            <label for="curp">CURP</label>
            <input type="text" name="curp" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp') }}" required>
            @error('curp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- NSS -->
        <div class="form-group mb-3">
            <label for="nss">NSS</label>
            <input type="text" name="nss" class="form-control @error('nss') is-invalid @enderror" value="{{ old('nss') }}" required>
            @error('nss')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Infonavit -->
        <div class="form-group mb-3">
            <label for="infonavit">Infonavit</label>
            <input type="text" name="infonavit" class="form-control @error('infonavit') is-invalid @enderror" value="{{ old('infonavit') }}">
            @error('infonavit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Puesto -->
        <div class="form-group mb-3">
            <label for="fk_id_puesto">Puesto</label>
            <select class="form-control @error('fk_id_puesto') is-invalid @enderror" name="fk_id_puesto" id="fk_id_puesto" required>
                <option value="">Seleccionar puesto</option>
                @foreach ($puestos as $puesto)
                    <option value="{{ $puesto->id_puesto }}" {{ old('fk_id_puesto') == $puesto->id_puesto ? 'selected' : '' }}>
                        {{ $puesto->nombre_puesto }}
                    </option>
                @endforeach
            </select>
            @error('fk_id_puesto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Sucursal -->
        <div class="form-group mb-3">
            <label for="fk_id_sucursal">Sucursal</label>
            <select class="form-control @error('fk_id_sucursal') is-invalid @enderror" name="fk_id_sucursal" id="fk_id_sucursal" required>
                <option value="">Seleccionar sucursal</option>
                @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}" {{ old('fk_id_sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>
                        {{ $sucursal->nombre_sucursal }}
                    </option>
                @endforeach
            </select>
            @error('fk_id_sucursal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fecha de Contratación -->
        <div class="form-group mb-3">
            <label for="fecha_contratacion">Fecha de Contratación</label>
            <input type="date" name="fecha_contratacion" class="form-control @error('fecha_contratacion') is-invalid @enderror" value="{{ old('fecha_contratacion') }}" required>
            @error('fecha_contratacion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Estado -->
        <div class="form-group mb-3">
            <label for="status">Estado</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Imagen -->
        <div class="form-group mb-3">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" class="form-control-file">
        </div>

        <!-- Botones -->
        <div class="mt-3">
            <button type="submit" class="btn btn-success">Guardar Empleado</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">← Regresar</a>
        </div>
    </form>
</div>
@endsection
