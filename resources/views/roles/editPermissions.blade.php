{{-- resources/views/roles/editPermissions.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar permisos para el rol: {{ $role->name }}</h2>
        
        <form action="{{ route('roles.updatePermissions', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <h4>Permisos disponibles</h4>
                @foreach($permissions as $permission)
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            @if($role->hasPermissionTo($permission->name)) checked @endif
                        >
                        {{ $permission->name }}
                    </label><br>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Permisos</button>
        </form>
    </div>
@endsection
