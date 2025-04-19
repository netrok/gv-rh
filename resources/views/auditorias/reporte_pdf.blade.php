<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Auditorías</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 40px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #0c4a6e;
            padding-bottom: 10px;
        }
        .header .logo {
            width: 150px;
        }
        .header .title {
            text-align: right;
        }
        .title h1 {
            margin: 0;
            font-size: 20px;
            color: #0c4a6e;
        }
        .title p {
            margin: 0;
            font-size: 12px;
        }
        .content {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 8px 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #e0f2fe;
            color: #0c4a6e;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" height="60">
        </div>
        <div class="title">
            <h1>Reporte de Auditorías</h1>
            <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="content">
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
                        <td>{{ $auditoria->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $auditoria->empleado->nombres ?? '-' }}</td>
                        <td>{{ ucfirst($auditoria->accion) }}</td>
                        <td>
                            @if(is_array($auditoria->changed_data))
                                @foreach($auditoria->changed_data as $key => $value)
                                    <strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}<br>
                                @endforeach
                            @else
                                {{ $auditoria->changed_data ?? '-' }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        © {{ date('Y') }} Tu Empresa. Todos los derechos reservados.
    </div>
</body>
</html>