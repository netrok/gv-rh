@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Sucursal</h1>

        <form action="{{ route('sucursales.update', $sucursal) }}" method="POST">
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
               value="{{ old('telefono_2', $sucursal->telefono_2) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
    </div>
@endsection