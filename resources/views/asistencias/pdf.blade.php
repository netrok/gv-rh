<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Asistencias</title>
    <style>
        @page {
            margin: 100px 50px 120px 50px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            text-align: center;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }

        .logo {
            width: 100px;
            margin-bottom: 5px;
        }

        h2 {
            margin: 0;
            color: #0d6efd;
        }

        .small {
            font-size: 10px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f1f1f1;
        }

        footer {
            position: fixed;
            bottom: -70px;
            left: 0;
            right: 0;
            font-size: 10px;
            color: #777;
            text-align: center;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 30px;
        }

        .firma {
            margin-top: 30px;
            text-align: left;
            font-size: 10px;
        }

        .firma hr {
            width: 200px;
            margin: 5px 0;
        }

    </style>
</head>
<body>

<header>
    <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
    <h2>Listado de Asistencias</h2>
    <p class="small">Generado el {{ now()->format('d/m/Y H:i') }}</p>
</header>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Núm. Empleado</th>
            <th>Nombre Completo</th>
            <th>Fecha</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Tipo</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asistencias as $index => $asistencia)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $asistencia->empleado->num_empleado ?? 'N/A' }}</td>
            <td>{{ $asistencia->empleado->nombre_completo ?? 'Empleado eliminado' }}</td>
            <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
            <td>{{ $asistencia->hora_entrada ?? '-' }}</td>
            <td>{{ $asistencia->hora_salida ?? '-' }}</td>
            <td>{{ ucfirst($asistencia->tipo) }}</td>
            <td>{{ $asistencia->observaciones ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<footer>
    <div class="footer-content">
        <div>Generado por: {{ auth()->user()->name }} ({{ auth()->user()->email }})</div>
        <div>Página {PAGE_NUM} de {PAGE_COUNT}</div>
    </div>

    <div class="firma">
        <hr>
        Firma Responsable
    </div>
</footer>

</body>
</html>