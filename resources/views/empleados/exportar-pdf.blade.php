<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Empleados</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0 40px;
            font-size: 12px;
            color: #333;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }
        header img {
            height: 60px;
        }
        header h1 {
            font-size: 24px;
            margin: 0;
            color: #007BFF;
        }
        .meta {
            font-size: 12px;
            margin-top: 10px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #007BFF;
            color: white;
            padding: 8px;
            text-align: left;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }
        .footer {
            position: absolute;
            bottom: 30px;
            right: 40px;
            font-size: 10px;
            color: #888;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ public_path('images/logo_empresa.png') }}" alt="Logo">
    <h1>Reporte de Empleados</h1>
</header>

<div class="meta">
    Generado por: {{ Auth::user()->name ?? 'Administrador' }}<br>
    Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
</div>

<table>
    <thead>
        <tr>
            <th>Número</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->num_empleado }}</td>
                <td>{{ $empleado->nombres }}</td>
                <td>{{ $empleado->apellidos }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ ucfirst($empleado->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Numeración de páginas --}}
@if (isset($pdf))
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script(function($pageNumber, $pageCount, $pdf) {
                $pdf->text(500, 820, "Página $pageNumber de $pageCount", null, 10);
            });
        }
    </script>
@endif

</body>
</html>
