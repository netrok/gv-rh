<!-- resources/views/puestos/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Puesto</h1>
        
        <form action="{{ route('puestos.update', $puesto->id_puesto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre_puesto">Nombre del Puesto</label>
                <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" value="{{ $puesto->nombre_puesto }}" required>
            </div>
            <div class="form-group">
                <label for="sueldo_base">Sueldo Base</label>
                <input type="number" class="form-control" id="sueldo_base" name="sueldo_base" value="{{ $puesto->sueldo_base }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="jefe_directo">Jefe Directo</label>
                <input type="text" class="form-control" id="jefe_directo" name="jefe_directo" value="{{ $puesto->jefe_directo }}" required>
            </div>
            <div class="form-group">
                <label for="status_puesto">Status del Puesto</label>
                <select class="form-control" id="status_puesto" name="status_puesto" required>
                    <option value="activo" {{ $puesto->status_puesto == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $puesto->status_puesto == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Puesto</button>
        </form>
    </div>
@endsection
