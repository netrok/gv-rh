@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalle de la Sucursal</h1>

    <div class="card shadow rounded mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $sucursal->nombre_sucursal }}</h4>
            <p class="mb-2"><strong>Dirección:</strong> {{ $sucursal->direccion }}</p>
            <p class="mb-2"><strong>Teléfono 1:</strong> {{ $sucursal->telefono_1 }}</p>
            <p class="mb-2"><strong>Teléfono 2:</strong> {{ $sucursal->telefono_2 ?? 'N/A' }}</p>
            <p class="mb-2"><strong>Celular:</strong> {{ $sucursal->celular }}</p>
            <p class="mb-2"><strong>Responsable:</strong> {{ $sucursal->responsable }}</p>
            <p class="mb-2"><strong>Email del Responsable:</strong> {{ $sucursal->email_responsable }}</p>
            <p class="mb-2">
                <strong>Estado:</strong> 
                <span class="badge {{ $sucursal->status_sucursal == 'activo' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($sucursal->status_sucursal) }}
                </span>
            </p>
            <p class="text-muted"><small>Última actualización: {{ $sucursal->updated_at->format('d/m/Y H:i') }}</small></p>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('sucursales.index') }}" class="btn btn-secondary">Volver al listado</a>
        <div>
            <a href="{{ route('sucursales.edit', $sucursal) }}" class="btn btn-primary me-2">Editar</a>
            <form action="{{ route('sucursales.destroy', $sucursal) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta sucursal?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection