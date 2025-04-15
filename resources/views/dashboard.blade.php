<canvas id="empleadosChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('empleadosChart').getContext('2d');
    const empleadosChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Activos', 'Inactivos'],
            datasets: [{
                label: 'Empleados',
                data: [{{ $empleadosActivosCount }}, {{ $empleadosInactivosCount }}],
                backgroundColor: ['green', 'gray'],
                borderColor: ['black', 'black'],
                borderWidth: 1
            }]
        }
    });
</script>
