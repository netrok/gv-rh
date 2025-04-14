@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Empleado</h1>

    <div class="card">
        <div class="card-body">
            <div class="form-group">           
                @if ($empleado->imagen)
                    <div class="mt-2">
                        <img src="{{ Storage::url($empleado->imagen) }}" alt="Imagen actual" width="100">
                    </div>
                @else
                    <p>No hay imagen disponible</p>
                @endif
            </div>

            <h5 class="card-title">{{ $empleado->nombres }} {{ $empleado->apellidos }}</h5>
            <p><strong>Número empleado:</strong> {{ $empleado->num_empleado }}</p>
            <p><strong>Domicilio:</strong> {{ $empleado->domicilio }}</p>
            <p><strong>Fecha nacimiento:</strong> {{ $empleado->fecha_nacimiento }}</p>
            <p><strong>Email:</strong> {{ $empleado->email }}</p>
            <p><strong>Teléfono:</strong> {{ $empleado->telefono }}</p>
            <p><strong>Celular:</strong> {{ $empleado->celular }}</p>
            <p><strong>INE:</strong> {{ $empleado->ine }}</p>
            <p><strong>CURP:</strong> {{ $empleado->curp }}</p>
            <p><strong>NSS:</strong> {{ $empleado->nss }}</p>
            <p><strong>Infonavit:</strong> {{ $empleado->infonavit }}</p>
            <p><strong>Fecha contratacion:</strong> {{ $empleado->fecha_contratacion }}</p>

            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $empleado->status == 'activo' ? 'success' : 'secondary' }}">
                    {{ ucfirst($empleado->status) }}
                </span>
            </p>

            <a href="{{ route('empleados.index') }}" class="btn btn-secondary mt-3">← Volver al listado</a>
            <a href="{{ route('empleados.pdf', $empleado->id_empleado) }}" class="btn btn-danger mt-3" target="_blank">📄 Generar PDF</a>
        </div>
    </div>
</div>
@endsection
