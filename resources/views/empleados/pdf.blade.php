<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Empleado - {{ $empleado->num_empleado }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
            position: relative;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            width: 120px;
        }
        h1 {
            font-size: 20px;
            margin: 0;
        }
        .fecha {
            font-size: 12px;
            text-align: right;
        }
        .datos {
            display: flex;
            gap: 20px;
        }
        .foto {
            width: 150px;
            height: auto;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .tabla-datos {
            width: 100%;
            border-collapse: collapse;
        }
        .tabla-datos th, .tabla-datos td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .tabla-datos th {
            width: 200px;
            background-color: #f2f2f2;
        }
        .status-activo {
            color: green;
            font-weight: bold;
        }
        .status-inactivo {
            color: gray;
            font-weight: bold;
        }
        .footer {
            position: absolute;
            bottom: 30px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            color: #888;
        }
        .firma {
            margin-top: 40px;
            text-align: center;
        }
        .firma img {
            width: 150px;
        }
        .qr {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
        </div>
        <div>
            <h1>Ficha del Empleado</h1>
            <p class="fecha">Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="datos">
        @if($empleado->imagen)
            <div>
                <img src="{{ public_path('storage/' . $empleado->imagen) }}" alt="Foto" class="foto">
            </div>
        @endif

        <table class="tabla-datos">
            <tr><th>Número de Empleado:</th><td>{{ $empleado->num_empleado }}</td></tr>
            <tr><th>Nombre:</th><td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td></tr>
            <tr><th>Domicilio:</th><td>{{ $empleado->domicilio }}</td></tr>
            <tr><th>Fecha de Nacimiento:</th><td>{{ $empleado->fecha_nacimiento }}</td></tr>
            <tr><th>Email:</th><td>{{ $empleado->email }}</td></tr>
            <tr><th>Teléfono:</th><td>{{ $empleado->telefono }}</td></tr>
            <tr><th>Celular:</th><td>{{ $empleado->celular }}</td></tr>
            <tr><th>INE:</th><td>{{ $empleado->ine }}</td></tr>
            <tr><th>CURP:</th><td>{{ $empleado->curp }}</td></tr>
            <tr><th>NSS:</th><td>{{ $empleado->nss }}</td></tr>
            <tr><th>INFONAVIT:</th><td>{{ $empleado->infonavit }}</td></tr>
            <tr><th>Fecha de Contratación:</th><td>{{ $empleado->fecha_contratacion }}</td></tr>
            <tr>
                <th>Status:</th>
                <td class="{{ $empleado->status == 'activo' ? 'status-activo' : 'status-inactivo' }}">
                    {{ ucfirst($empleado->status) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="qr">
        @php
            $qrData = "ID: {$empleado->num_empleado}\nNombre: {$empleado->nombres} {$empleado->apellidos}";
        @endphp
        {!! QrCode::size(80)->generate($qrData) !!}
    </div>

    <div class="firma">
        <p>__________________________</p>
        <p>Responsable de RRHH</p>
        <img src="{{ public_path('images/firma.png') }}" alt="Firma Responsable">
    </div>

    <div class="footer">
        Documento generado automáticamente por el sistema de gestión de empleados.
    </div>

</body>
</html>
