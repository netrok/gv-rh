@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Roles</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Crear rol -->
    <form action="{{ route('roles.create') }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="name" placeholder="Nombre del rol" required>
        <button type="submit" class="btn btn-success">Crear Rol</button>
    </form>

    <!-- Mostrar roles -->
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.assignPermissions', $role->id) }}" class="btn btn-warning btn-sm">Asignar Permisos</a>
                        <a href="{{ route('roles.assignRoleToUser', $role->id) }}" class="btn btn-primary btn-sm">Asignar a Usuario</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
