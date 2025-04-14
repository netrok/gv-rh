// En la vista roles/assignPermissions.blade.php
<form action="{{ route('roles.assignPermissions', $role->id) }}" method="POST">
    @csrf
    @foreach ($permissions as $permission)
        <div>
            <label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                    {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                {{ $permission->name }}
            </label>
        </div>
    @endforeach
    <button type="submit" class="btn btn-success">Guardar Permisos</button>
</form>
