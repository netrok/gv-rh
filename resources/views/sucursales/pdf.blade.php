<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Sucursales</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Listado de Sucursales</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono 1</th>
                <th>Teléfono 2</th>
                <th>Celular</th>
                <th>Responsable</th>
                <th>Email</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sucursales as $sucursal)
                <tr>
                    <td>{{ $sucursal->nombre_sucursal }}</td>
                    <td>{{ $sucursal->direccion }}</td>
                    <td>{{ $sucursal->telefono_1 }}</td>
                    <td>{{ $sucursal->telefono_2 }}</td>
                    <td>{{ $sucursal->celular }}</td>
                    <td>{{ $sucursal->responsable }}</td>
                    <td>{{ $sucursal->email_responsable }}</td>
                    <td>{{ ucfirst($sucursal->status_sucursal) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>