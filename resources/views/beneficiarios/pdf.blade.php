<!-- resources/views/beneficiarios/pdf.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha del Beneficiario - {{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</title>
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

        .datos {
            display: flex;
            gap: 30px;
        }

        .foto {
            width: 130px;
            height: auto;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .tabla-datos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .tabla-datos th,
        .tabla-datos td {
            padding: 6px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .tabla-datos th {
            background-color: #f9f9f9;
            color: #34495e;
            width: 200px;
        }

        .section-title {
            background-color: #2c3e50;
            color: white;
            padding: 5px 10px;
            margin-top: 20px;
            font-size: 14px;
        }

        .status-activo {
            color: green;
            font-weight: bold;
        }

        .status-inactivo {
            color: #aaa;
            font-weight: bold;
        }

        .firma {
            margin-top: 50px;
            text-align: center;
        }

        .firma img {
            width: 120px;
            margin-top: 5px;
        }

        .firma p {
            margin: 5px 0;
        }

        .qr {
            text-align: right;
            margin-top: 10px;
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

        .footer-legal {
            font-size: 10px;
            color: #999;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="watermark">CONFIDENCIAL</div>

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
        <div class="empresa-info">
            <h1>Nombre de la Empresa</h1>
            <p>Ficha del Beneficiario</p>
            <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="titulo">Información General del Beneficiario</div>

    <div class="datos">
        <table class="tabla-datos">
            <tr>
                <th>ID Beneficiario:</th>
                <td>{{ $beneficiario->id_beneficiario }}</td>
            </tr>
            <tr>
                <th>Empleado:</th>
                <td>
                    @if($beneficiario->empleado)
                        {{ $beneficiario->empleado->nombres }} {{ $beneficiario->empleado->apellidos }}
                    @else
                        <span class="text-muted">Sin empleado asignado</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Nombre Completo:</th>
                <td>{{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</td>
            </tr>
            <tr>
                <th>Parentesco:</th>
                <td>{{ $beneficiario->parentesco }}</td>
            </tr>
            <tr>
                <th>Porcentaje:</th>
                <td>{{ $beneficiario->porcentaje }}%</td>
            </tr>
            <tr>
                <th>RFC:</th>
                <td>{{ $beneficiario->rfc }}</td>
            </tr>
            <tr>
                <th>Domicilio:</th>
                <td>{{ $beneficiario->domicilio }}</td>
            </tr>
        </table>
    </div>

    <div class="qr">
        @php
            $qrData = "ID: {$beneficiario->id_beneficiario}\nNombre: {$beneficiario->nombres} {$beneficiario->apellidos}";
        @endphp
        {!! QrCode::size(80)->generate($qrData) !!}
    </div>

    <div class="firma">
        <p>______________________________</p>
        <p>Firma del Responsable</p>
        <img src="{{ public_path('images/firma.png') }}" alt="Firma">
        <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>

    <div class="footer">
        Documento confidencial. Generado automáticamente por el sistema de gestión de beneficiarios.
    </div>

    <div class="footer-legal">
        © {{ date('Y') }} Nombre de la Empresa. Todos los derechos reservados. Este documento contiene información confidencial destinada únicamente a fines internos.
    </div>

</body>

</html>