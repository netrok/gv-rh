<!-- resources/views/puestos/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Puesto</h1>
        
        <form action="{{ route('puestos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_puesto">Nombre del Puesto</label>
                <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" required>
            </div>
            <div class="form-group">
                <label for="sueldo_base">Sueldo Base</label>
                <input type="number" class="form-control" id="sueldo_base" name="sueldo_base" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="jefe_directo">Jefe Directo</label>
                <input type="text" class="form-control" id="jefe_directo" name="jefe_directo" required>
            </div>
            <div class="form-group">
                <label for="status_puesto">Status del Puesto</label>
                <select class="form-control" id="status_puesto" name="status_puesto" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Puesto</button>
        </form>
    </div>
@endsection
