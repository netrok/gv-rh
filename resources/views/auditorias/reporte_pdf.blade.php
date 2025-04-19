<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Auditorías</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Auditorías</h1>
    
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
                            @foreach($auditoria->changed_data as $key => $value)
                                <strong>{{ $key }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}<br>
                            @endforeach
                        @else
                            {{ $auditoria->changed_data ?? '-' }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>