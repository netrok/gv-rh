@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roles</h1>

    <!-- Listado de Roles -->
    <ul>
        @foreach($roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>

    <h2>Assign Permissions to a Role</h2>

    <!-- Formulario para asignar permisos -->
    <form action="{{ url('roles/'.$role->id.'/permissions') }}" method="POST">
        @csrf

        <h3>Permissions</h3>
        @foreach($permissions as $permission)
            <label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                {{ $permission->name }}
            </label>
            <br>
        @endforeach

        <button type="submit">Assign Permissions</button>
    </form>
</div>
@endsection
