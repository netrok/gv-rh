{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <p>Total empleados: {{ $empleadosCount }}</p>
        <p>Activos: {{ $empleadosActivosCount }}</p>
        <p>Inactivos: {{ $empleadosInactivosCount }}</p>
    </div>
@endsection