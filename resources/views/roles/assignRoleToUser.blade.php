@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignar Rol a Usuario</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('roles.assignRoleToUser', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="role">Seleccionar Rol</label>
            <select name="role" id="role" class="form-control" required>
                <option value="">Seleccionar rol</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Asignar Rol</button>
    </form>
</div>
@endsection
