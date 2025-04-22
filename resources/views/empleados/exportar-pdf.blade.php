@php use Illuminate\Support\Facades\Auth; @endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Empleados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #2c3e50;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
        }

        .empresa-info {
            text-align: right;
        }

        .empresa-info h1 {
            margin: 0;
            font-size: 18px;
            color: #2c3e50;
        }

        .empresa-info p {
            margin: 0;
            font-size: 11px;
        }

        .titulo {
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .tabla-empleados {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .tabla-empleados th,
        .tabla-empleados td {
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .tabla-empleados th {
            background-color: #2c3e50;
            color: white;
        }

        .status-activo {
            color: green;
            font-weight: bold;
        }

        .status-inactivo {
            color: #aaa;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }

        .watermark {
            position: fixed;
            top: 40%;
            left: 25%;
            font-size: 60px;
            color: rgba(200, 200, 200, 0.15);
            transform: rotate(-30deg);
            z-index: 0;
            font-weight: bold;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <div class="watermark">CONFIDENCIAL</div>

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
        <div class="empresa-info">
            <h1>Nombre de la Empresa</h1>
            <p>Reporte General de Empleados</p>
            <p>Generado por: {{ Auth::user()->name ?? 'Administrador' }}</p>
            <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="titulo">Listado de Empleados</div>

    <table class="tabla-empleados">
        <thead>
            <tr>
                <th>#</th>
                <th>Número</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $index => $empleado)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $empleado->num_empleado }}</td>
                    <td>{{ $empleado->nombres }}</td>
                    <td>{{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td class="{{ $empleado->status == 'activo' ? 'status-activo' : 'status-inactivo' }}">
                        {{ ucfirst($empleado->status) }}
                    </td>
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

    <div class="footer">
        Documento confidencial. Generado automáticamente por el sistema de gestión de empleados. <br>
        Página {PAGE_NUM} de {PAGE_COUNT}
    </div>

</body>

</html>