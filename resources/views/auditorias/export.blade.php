<table>
    <thead>
        <tr>
            <th>Empleado</th>
            <th>Acción</th>
            <th>Cambios</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($auditorias as $a)
            <tr>
                <td>{{ $a->empleado->nombres ?? 'Empleado eliminado' }}</td>
                <td>{{ ucfirst($a->accion) }}</td>
                <td>
                    @foreach($a->changed_data as $campo => $valores)
                        {{ $campo }}: "{{ $valores['old'] ?? '-' }}" → "{{ $valores['new'] ?? '-' }}"<br>
                    @endforeach
                </td>
                <td>{{ $a->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>