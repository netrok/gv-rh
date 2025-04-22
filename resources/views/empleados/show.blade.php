<?php use Illuminate\Support\Facades\Storage; ?>

@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-primary">👤 Detalles del Empleado</h2>
            <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver al listado
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-4">

                    <div class="col-md-3 text-center">
                        @if($empleado->imagen)
                            <img src="{{ Storage::url($empleado->imagen) }}" alt="Foto del empleado"
                                class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                        @else
                            <div class="bg-light border rounded py-5 px-3 text-muted">
                                <i class="bi bi-person-circle fs-1"></i><br>Sin imagen
                            </div>
                        @endif
                    </div>

                    <div class="col-md-9">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-semibold">Número de Empleado:</label>
                                <div>{{ $empleado->num_empleado }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">Nombre Completo:</label>
                                <div>{{ $empleado->nombres }} {{ $empleado->apellidos }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">Email:</label>
                                <div>{{ $empleado->email }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">Teléfono:</label>
                                <div>{{ $empleado->telefono }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">Celular:</label>
                                <div>{{ $empleado->celular }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">CURP:</label>
                                <div>{{ $empleado->curp }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">NSS:</label>
                                <div>{{ $empleado->nss }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold">Infonavit:</label>
                                <div>{{ $empleado->infonavit }}</div>
                            </div>
                            <div class="col-md-12">
                                <label class="fw-semibold">Domicilio:</label>
                                <div>{{ $empleado->domicilio }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold">Nacimiento:</label>
                                <div>{{ \Carbon\Carbon::parse($empleado->fecha_nacimiento)->format('d/m/Y') }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold">Contratación:</label>
                                <div>{{ \Carbon\Carbon::parse($empleado->fecha_contratacion)->format('d/m/Y') }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold">INE:</label>
                                <div>{{ $empleado->ine }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold">Estado:</label>
                                <span class="badge bg-{{ $empleado->status === 'activo' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($empleado->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection