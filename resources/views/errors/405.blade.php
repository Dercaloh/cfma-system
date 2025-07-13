@extends('errors::minimal')

@section('title', __('Método no permitido'))
@section('code', '405')
@section('message', __('El método de solicitud no está permitido para esta ruta.'))

@section('custom')
    <section class="max-w-2xl p-6 mx-auto my-10 space-y-4 text-center bg-white rounded shadow-md">
        <h1 class="text-3xl font-bold text-sena-azul">Método no permitido</h1>
        <p class="text-gray-700">
            Has intentado acceder a una ruta que no permite el método utilizado (por ejemplo, abrir una ruta que solo acepta POST).
        </p>

        <a href="{{ url()->previous() }}" class="inline-block px-5 py-2 mt-4 font-semibold text-white rounded bg-sena-azul hover:bg-sena-azul-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sena-azul">
            ⬅️ Volver atrás
        </a>

        <p class="mt-4 text-sm text-gray-500">
            Código de error: 405 – SGPTI | CFMA – SENA
        </p>
    </section>
@endsection
