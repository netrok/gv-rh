<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Empleado</th>
            <th>Acción</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
        @foreach($auditorias as $auditoria)
            <tr>
                <td>{{ $auditoria->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ $auditoria->empleado->nombres ?? '-' }}</td>
                <td>{{ $auditoria->accion }}</td>
                <td>
                    @if(is_array($auditoria->changed_data))
                        <ul style="margin: 0; padding-left: 15px;">
                            @foreach($auditoria->changed_data as $key => $value)
                                <li>
                                    <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                    {{ is_array($value) ? json_encode($value) : $value }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        {{ $auditoria->changed_data ?? '-' }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>