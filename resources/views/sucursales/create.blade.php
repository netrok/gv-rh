@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Sucursal</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Hubo algunos problemas con los datos ingresados.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sucursales.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="nombre_sucursal">Nombre de la Sucursal</label>
            <input type="text" class="form-control @error('nombre_sucursal') is-invalid @enderror" 
                   id="nombre_sucursal" name="nombre_sucursal" value="{{ old('nombre_sucursal') }}" required>
            @error('nombre_sucursal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" 
                   id="direccion" name="direccion" value="{{ old('direccion') }}" required>
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="telefono_1">Teléfono 1</label>
            <input type="text" class="form-control @error('telefono_1') is-invalid @enderror" 
                   id="telefono_1" name="telefono_1" value="{{ old('telefono_1') }}" required>
            @error('telefono_1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="telefono_2">Teléfono 2</label>
            <input type="text" class="form-control @error('telefono_2') is-invalid @enderror" 
                   id="telefono_2" name="telefono_2" value="{{ old('telefono_2') }}">
            @error('telefono_2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="celular">Celular</label>
            <input type="text" class="form-control @error('celular') is-invalid @enderror" 
                   id="celular" name="celular" value="{{ old('celular') }}" required>
            @error('celular')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="responsable">Responsable</label>
            <input type="text" class="form-control @error('responsable') is-invalid @enderror" 
                   id="responsable" name="responsable" value="{{ old('responsable') }}" required>
            @error('responsable')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email_responsable">Email del Responsable</label>
            <input type="email" class="form-control @error('email_responsable') is-invalid @enderror" 
                   id="email_responsable" name="email_responsable" value="{{ old('email_responsable') }}" required>
            @error('email_responsable')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="status_sucursal">Estado</label>
            <select class="form-control @error('status_sucursal') is-invalid @enderror" 
                    id="status_sucursal" name="status_sucursal" required>
                <option value="activo" {{ old('status_sucursal') == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('status_sucursal') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('status_sucursal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('sucursales.index') }}" class="btn btn-secondary">Volver al listado</a>
            <button type="submit" class="btn btn-success">Guardar Sucursal</button>
        </div>
    </form>
</div>
@endsection