@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Usuarios</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('roles.showAssignRoleForm', $user->id) }}" class="btn btn-primary btn-sm">Asignar Rol</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
