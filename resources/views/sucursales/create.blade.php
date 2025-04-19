@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nueva Sucursal</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h5>Corrige los siguientes errores:</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow rounded">
        <div class="card-body">
            <form action="{{ route('sucursales.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre_sucursal" class="form-label">Nombre</label>
                        <input type="text" name="nombre_sucursal" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="telefono_1" class="form-label">Teléfono 1</label>
                        <input type="text" name="telefono_1" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="telefono_2" class="form-label">Teléfono 2</label>
                        <input type="text" name="telefono_2" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" name="celular" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="responsable" class="form-label">Responsable</label>
                        <input type="text" name="responsable" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="email_responsable" class="form-label">Email del Responsable</label>
                        <input type="email" name="email_responsable" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="status_sucursal" class="form-label">Estado</label>
                        <select name="status_sucursal" class="form-select" required>
                            <option value="activo" selected>Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Sucursal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection