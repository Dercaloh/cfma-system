{{-- resources/views/politicas/show.blade.php --}}
@extends('layouts.public')

@section('title', 'Política de Protección de Datos Personales')

@section('content')
    <x-legal.section-legal
        title="ACUERDO DE TRATAMIENTO DE DATOS PERSONALES"
        subtitle="Sistema de Gestión de Préstamos e Inventario de Activos de TI — CFMA"
    >
        <x-legal.privacy-policy
            formulario="true"
            version="1.0.0"
            vigenteDesde="03/Julio/2023"
        />
    </x-legal.section-legal>
@endsection
