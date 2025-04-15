<h1>Historial de Cambios</h1>
<table>
    <thead>
        <tr>
            <th>Acción</th>
            <th>Fecha</th>
            <th>Datos Cambiados</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($audits as $audit)
            <tr>
                <td>{{ ucfirst($audit->action) }}</td>
                <td>{{ $audit->created_at }}</td>
                <td>{{ $audit->changed_data }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
