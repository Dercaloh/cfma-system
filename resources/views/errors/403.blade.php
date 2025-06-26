@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')
    <div class="text-center mt-5">
        <h1 class="text-danger display-4">403</h1>
        <p class="fs-4">No tienes permisos para acceder a esta sección.</p>
        <a href="{{ url()->previous() }}" class="btn btn-success">Volver</a>
    </div>
@endsection
