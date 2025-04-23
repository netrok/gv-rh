@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" id="sidebar">
        <h4>Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('dashboard') }}">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('empleados.index') }}">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('sucursales.index') }}">Sucursales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('puestos.index') }}">Puestos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('vacaciones.index') }}">Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('beneficiarios.index') }}">Beneficiarios</a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container mt-4">
            <h1 class="mb-4">Dashboard de Recursos Humanos</h1>

            {{-- Tarjetas resumen --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary shadow hover-effect">
                        <div class="card-body">
                            <h5 class="card-title">Total de Empleados</h5>
                            <p class="card-text display-4">{{ $totalEmpleados }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success shadow hover-effect">
                        <div class="card-body">
                            <h5 class="card-title">Sucursales</h5>
                            <p class="card-text display-4">{{ $totalSucursales }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info shadow hover-effect">
                        <div class="card-body">
                            <h5 class="card-title">Puestos</h5>
                            <p class="card-text display-4">{{ $totalPuestos }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Asistencias Hoy --}}
            <div class="col-md-6 mb-4">
                <div class="card text-white bg-secondary shadow hover-effect">
                    <div class="card-body">
                        <h5 class="card-title">Asistencias Hoy</h5>
                        <p class="card-text display-4">{{ $asistenciasHoy }}</p>
                    </div>
                </div>
            </div>

            {{-- Cumpleaños del mes --}}
            <div class="card mb-4 shadow hover-effect">
                <div class="card-body">
                    <h5 class="card-title">Cumpleaños del mes 🎂</h5>
                    @if($cumpleaneros->count())
                        <ul class="list-group list-group-flush">
                            @foreach($cumpleaneros as $emp)
                                <li class="list-group-item" style="font-size: 1.25rem;">
                                    {{ $emp->nombre }} - {{ \Carbon\Carbon::parse($emp->fecha_nacimiento)->format('d M') }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted" style="font-size: 1.25rem;">No hay cumpleaños este mes.</p>
                    @endif
                </div>
            </div>

            {{-- Gráfica de empleados por sucursal --}}
            <div class="card shadow hover-effect">
                <div class="card-body">
                    <h5 class="card-title">Empleados por Sucursal</h5>
                    <canvas id="graficaSucursal" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Gráfico de empleados por sucursal
    const ctx = document.getElementById('graficaSucursal').getContext('2d');
    const graficaSucursal = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($empleadosPorSucursal->pluck('sucursal.nombre')) !!},
            datasets: [{
                label: 'Empleados',
                data: {!! json_encode($empleadosPorSucursal->pluck('total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return 'Empleados: ' + tooltipItem.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Notificación Toast
    @if(session('status'))
        toastr.success("{{ session('status') }}", '¡Éxito!');
    @endif
</script>
@endsection
