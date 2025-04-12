<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Empleados</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Lista de Empleados</h2>
    <table>
        <thead>
            <tr>
                <th>Número de Empleado</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo Electrónico</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->num_empleado }}</td>
                    <td>{{ $empleado->nombres }}</td>
                    <td>{{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
