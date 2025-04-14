<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Empleados</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Listado de Empleados</h2>
    <table>
        <thead>
            <tr>
                <th>Num</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
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
