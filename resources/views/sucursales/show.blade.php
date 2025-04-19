@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles de la Sucursal</h2>

    <div class="card shadow rounded">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5><strong>Nombre:</strong></h5>
                    <p>{{ $sucursal->nombre_sucursal }}</p>
                </div>
                <div class="col-md-6">
                    <h5><strong>Dirección:</strong></h5>
                    <p>{{ $sucursal->direccion }}</p>
                </div>
                <div class="col-md-4">
                    <h5><strong>Teléfono 1:</strong></h5>
                    <p>{{ $sucursal->telefono_1 }}</p>
                </div>
                <div class="col-md-4">
                    <h5><strong>Teléfono 2:</strong></h5>
                    <p>{{ $sucursal->telefono_2 }}</p>
                </div>
                <div class="col-md-4">
                    <h5><strong>Celular:</strong></h5>
                    <p>{{ $sucursal->celular }}</p>
                </div>
                <div class="col-md-6">
                    <h5><strong>Responsable:</strong></h5>
                    <p>{{ $sucursal->responsable }}</p>
                </div>
                <div class="col-md-6">
                    <h5><strong>Email Responsable:</strong></h5>
                    <p>{{ $sucursal->email_responsable }}</p>
                </div>
                <div class="col-md-3">
                    <h5><strong>Estado:</strong></h5>
                    <span class="badge bg-{{ $sucursal->status_sucursal == 'activo' ? 'success' : 'secondary' }}">
                        {{ ucfirst($sucursal->status_sucursal) }}
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <div>
                    <a href="{{ route('sucursales.edit', $sucursal->id_sucursal) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('sucursales.destroy', $sucursal->id_sucursal) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar esta sucursal?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection