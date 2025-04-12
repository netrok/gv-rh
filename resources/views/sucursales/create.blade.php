<!-- resources/views/sucursales/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nueva Sucursal</h1>

        <form action="{{ route('sucursales.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_sucursal">Nombre de la Sucursal</label>
                <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <textarea class="form-control" id="direccion" name="direccion" required></textarea>
            </div>
            <div class="form-group">
                <label for="telefono_1">Teléfono 1</label>
                <input type="text" class="form-control" id="telefono_1" name="telefono_1" required>
            </div>
            <div class="form-group">
                <label for="telefono_2">Teléfono 2</label>
                <input type="text" class="form-control" id="telefono_2" name="telefono_2" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" required>
            </div>
            <div class="form-group">
                <label for="responsable">Responsable</label>
                <input type="text" class="form-control" id="responsable" name="responsable" required>
            </div>
            <div class="form-group">
                <label for="email_responsable">Email Responsable</label>
                <input type="email" class="form-control" id="email_responsable" name="email_responsable" required>
            </div>
            <div class="form-group">
                <label for="status_suursal">Status de la Sucursal</label>
                <select class="form-control" id="status_suursal" name="status_suursal" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Sucursal</button>
        </form>
    </div>
@endsection
