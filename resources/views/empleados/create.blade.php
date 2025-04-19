@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h3 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Crear Nuevo Empleado</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="num_empleado" class="form-label">Número de Empleado</label>
                        <input type="text" name="num_empleado" class="form-control @error('num_empleado') is-invalid @enderror" value="{{ old('num_empleado') }}" required>
                        @error('num_empleado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres') }}" required>
                        @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" required>
                        @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="domicilio" class="form-label">Domicilio</label>
                        <input type="text" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" value="{{ old('domicilio') }}" required>
                        @error('domicilio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" required>
                        @error('fecha_nacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" maxlength="10">
                        @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular') }}" maxlength="10">
                        @error('celular') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="ine" class="form-label">INE</label>
                        <input type="text" name="ine" class="form-control @error('ine') is-invalid @enderror" value="{{ old('ine') }}" required>
                        @error('ine') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="curp" class="form-label">CURP</label>
                        <input type="text" name="curp" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp') }}" required>
                        @error('curp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="nss" class="form-label">NSS</label>
                        <input type="text" name="nss" class="form-control @error('nss') is-invalid @enderror" value="{{ old('nss') }}" required>
                        @error('nss') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="infonavit" class="form-label">Infonavit</label>
                        <input type="text" name="infonavit" class="form-control @error('infonavit') is-invalid @enderror" value="{{ old('infonavit') }}">
                        @error('infonavit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fk_id_puesto" class="form-label">Puesto</label>
                        <select name="fk_id_puesto" class="form-select @error('fk_id_puesto') is-invalid @enderror" required>
                            <option value="">Seleccionar puesto</option>
                            @foreach ($puestos as $puesto)
                                <option value="{{ $puesto->id_puesto }}" {{ old('fk_id_puesto') == $puesto->id_puesto ? 'selected' : '' }}>
                                    {{ $puesto->nombre_puesto }}
                                </option>
                            @endforeach
                        </select>
                        @error('fk_id_puesto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fk_id_sucursal" class="form-label">Sucursal</label>
                        <select name="fk_id_sucursal" class="form-select @error('fk_id_sucursal') is-invalid @enderror" required>
                            <option value="">Seleccionar sucursal</option>
                            @foreach ($sucursales as $sucursal)
                                <option value="{{ $sucursal->id_sucursal }}" {{ old('fk_id_sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>
                                    {{ $sucursal->nombre_sucursal }}
                                </option>
                            @endforeach
                        </select>
                        @error('fk_id_sucursal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
                        <input type="date" name="fecha_contratacion" class="form-control @error('fecha_contratacion') is-invalid @enderror" value="{{ old('fecha_contratacion') }}" required>
                        @error('fecha_contratacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="imagen" class="form-label">Foto de Empleado</label>
                        <input type="file" name="imagen" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('empleados.index') }}" class="btn btn-secondary me-2">← Cancelar</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i>Guardar Empleado
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection