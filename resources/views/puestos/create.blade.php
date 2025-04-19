@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Crear Nuevo Puesto</h1>
        
        <form action="{{ route('puestos.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="nombre_puesto" class="form-label">Nombre del Puesto</label>
                        <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="sueldo_base" class="form-label">Sueldo Base</label>
                        <input type="number" class="form-control" id="sueldo_base" name="sueldo_base" step="0.01" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="jefe_directo" class="form-label">Jefe Directo</label>
                        <input type="text" class="form-control" id="jefe_directo" name="jefe_directo" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="status_puesto" class="form-label">Status del Puesto</label>
                        <select class="form-select" id="status_puesto" name="status_puesto" required>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Crear Puesto
                </button>
                <a href="{{ route('puestos.index') }}" class="btn btn-secondary ms-2">
                    <i class="fas fa-undo"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection