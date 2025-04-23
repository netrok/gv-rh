{{-- resources/views/empleados/partials/form.blade.php --}}
@php use Illuminate\Support\Facades\Storage; @endphp


@if ($errors->any())
    <div class="alert alert-danger shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ isset($empleado) ? route('empleados.update', $empleado->id_empleado) : route('empleados.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($empleado))
                @method('PUT')
            @endif

            <div class="row g-3">
                {{-- Campo Número de Empleado --}}
                <div class="col-md-4">
                    <label class="form-label">Número de Empleado</label>
                    <input type="text" name="num_empleado" class="form-control" 
                           value="{{ old('num_empleado', $empleado->num_empleado ?? '') }}" required>
                </div>

                {{-- Nombres y Apellidos --}}
                <div class="col-md-4">
                    <label class="form-label">Nombres</label>
                    <input type="text" name="nombres" class="form-control" 
                           value="{{ old('nombres', $empleado->nombres ?? '') }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" 
                           value="{{ old('apellidos', $empleado->apellidos ?? '') }}" required>
                </div>

                {{-- Contacto --}}
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" 
                           value="{{ old('email', $empleado->email ?? '') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" 
                           value="{{ old('telefono', $empleado->telefono ?? '') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Celular</label>
                    <input type="text" name="celular" class="form-control" 
                           value="{{ old('celular', $empleado->celular ?? '') }}">
                </div>

                {{-- Datos personales --}}
                <div class="col-md-6">
                    <label class="form-label">CURP</label>
                    <input type="text" name="curp" class="form-control" 
                           value="{{ old('curp', $empleado->curp ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">NSS</label>
                    <input type="text" name="nss" class="form-control" 
                           value="{{ old('nss', $empleado->nss ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Infonavit</label>
                    <input type="text" name="infonavit" class="form-control" 
                           value="{{ old('infonavit', $empleado->infonavit ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Domicilio</label>
                    <input type="text" name="domicilio" class="form-control" 
                           value="{{ old('domicilio', $empleado->domicilio ?? '') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control"
                           value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento ?? '') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fecha de Contratación</label>
                    <input type="date" name="fecha_contratacion" class="form-control"
                           value="{{ old('fecha_contratacion', $empleado->fecha_contratacion ?? '') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">INE</label>
                    <input type="text" name="ine" class="form-control" 
                           value="{{ old('ine', $empleado->ine ?? '') }}">
                </div>

                {{-- Estado --}}
                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="activo" {{ old('status', $empleado->status ?? '') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('status', $empleado->status ?? '') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                {{-- Puesto --}}
                <div class="col-md-6">
                    <label class="form-label">Puesto</label>
                    <select name="fk_id_puesto" class="form-select" required>
                        <option value="">Seleccionar Puesto</option>
                        @foreach ($puestos as $puesto)
                            <option value="{{ $puesto->id_puesto }}" 
                                    @if (old('fk_id_puesto', $empleado->fk_id_puesto ?? '') == $puesto->id_puesto) selected @endif>
                                {{ $puesto->nombre_puesto }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sucursal --}}
                <div class="col-md-6">
                    <label class="form-label">Sucursal</label>
                    <select name="fk_id_sucursal" class="form-select" required>
                        <option value="">Seleccionar Sucursal</option>
                        @foreach ($sucursales as $sucursal)
                            <option value="{{ $sucursal->id_sucursal }}" 
                                    @if (old('fk_id_sucursal', $empleado->fk_id_sucursal ?? '') == $sucursal->id_sucursal) selected @endif>
                                {{ $sucursal->nombre_sucursal }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Imagen --}}
                <div class="col-md-6">
                    <label class="form-label">Imagen</label>
                    <input type="file" name="imagen" class="form-control">
                    @if (isset($empleado) && $empleado->imagen)
                        <div class="mt-2">
                            <img src="{{ Storage::url($empleado->imagen) }}" alt="Imagen actual" width="100" class="rounded shadow-sm">
                        </div>
                    @endif
                </div>

                {{-- Botones --}}
                <div class="col-12 d-flex justify-content-between mt-4">
                    <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary shadow">
                        <i class="bi bi-save"></i> {{ isset($empleado) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>