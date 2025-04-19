@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Crear Empleado</h2>
    @include('empleados.partials.form', ['empleado' => null])
</div>
@endsection