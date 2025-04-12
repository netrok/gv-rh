<!-- resources/views/sucursales/edit.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Editar Sucursal</h1>
        

        <form action="{{ route('sucursales.update', $sucursal->id) }}" method="POST">
            @csrf
            @method('PUT')
            

            <div class="form-group">
                <label for="nombre_sucursal">Nombre de la Sucursal</label>
                <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal"
                       value="{{ old('nombre_sucursal', $sucursal->nombre_sucursal) }}" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                       value="{{ old('direccion', $sucursal->direccion) }}" required>
            </div>

            <div class="form-group">
                <label for="telefono_1">Teléfono 1</label>
                <input type="text" class="form-control" id="telefono_1" name="telefono_1"
                       value="{{ old('telefono_1', $sucursal->telefono_1) }}" required>
            </div>

            <div class="form-group">
                <label for="telefono_2">Teléfono 2</label>
                <input type="text" class="form-control" id="telefono_2" name="telefono_2"
                       value="{{ old('telefono_2', $sucursal->telefono_2) }}">
            </div>

            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular"
                       value="{{ old('celular', $sucursal->celular) }}" required>
            </div>

            <div class="form-group">
                <label for="responsable">Responsable</label>
                <input type="text" class="form-control" id="responsable" name="responsable"
                       value="{{ old('responsable', $sucursal->responsable) }}" required>
            </div>

            <div class="form-group">
                <label for="email_responsable">Email del Responsable</label>
                <input type="email" class="form-control" id="email_responsable" name="email_responsable"
                       value="{{ old('email_responsable', $sucursal->email_responsable) }}" required>
            </div>

            <div class="form-group">
                <label for="status_sucursal">Estado</label>
                <select class="form-control" id="status_sucursal" name="status_sucursal" required>
                    <option value="activo" {{ $sucursal->status_sucursal == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $sucursal->status_sucursal == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar Sucursal</button>
        </form>
    </div>
@endsection
