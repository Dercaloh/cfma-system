@extends('layouts.public')

@section('title', 'Política de Protección de Datos Personales')

@section('content')

    <div class="header privacy-policy .header">
        <h1 class="mb-2 text-2xl font-bold text-center text-sena-azul">ACUERDO DE TRATAMIENTO DE DATOS PERSONALES</h1>
        <h2 class="mb-1 text-lg text-center text-gray-700">Sistema de Gestión de Préstamos e Inventario de Activos de TI</h2>
        <h3 class="font-semibold text-center">Centro de Formación Minero Ambiental (CFMA)</h3>
        <h4  class="text-sm italic text-center text-gray-700" >  Versión 1.0 - Vigente desde 03/Julio/2023</p></h4>
    </div>

    <div class="privacy-policy">

        <h2 class="text-lg font-semibold">1. Responsable del Tratamiento</h2>
        <p>El <strong>SERVICIO NACIONAL DE APRENDIZAJE - SENA</strong>, identificado con NIT 899.999.034-1, con domicilio en
            Calle 57 No. 8-69, Bogotá D.C., es el responsable del tratamiento de sus datos personales.</p>
        <ul class="list-disc list-inside">
            <li><strong>Contacto:</strong> servicioalciudadano@sena.edu.co</li>
            <li><strong>Teléfono:</strong> (601) 546 1500 ext. 12453 - 13006</li>
            <li><strong>Política completa:</strong> <a href="https://compromiso.sena.edu.co/mapa/descarga.php?id=3628"
                    target="_blank" class="text-blue-600 underline">Consultar política de datos</a></li>
        </ul>

        <h2 class="text-lg font-semibold">2. Finalidades del Tratamiento</h2>
        <p>Sus datos serán utilizados para:</p>
        <x-tabla-finalidades />

        <h2 class="text-lg font-semibold">3. Datos Personales Recolectados</h2>
        <p>Recolectamos únicamente los datos necesarios para las finalidades descritas:</p>
        <x-tabla-datos-personales />

        <h2 class="text-lg font-semibold">4. Gestión de Activos</h2>
        <p>Al usar el sistema de préstamos, acepta:</p>
        <ul class="list-disc list-inside">
            <li>Los registros digitales son prueba válida de transacciones</li>
            <li>Es responsable de los activos durante el período de préstamo</li>
            <li>Debe reportar anomalías dentro de 24 horas tras el check-in</li>
            <li>El SENA implementa medidas de seguridad razonables</li>
        </ul>

        <h3 class="font-semibold">4.1 Proceso de Check-in/Check-out</h3>
        <ul class="list-disc list-inside">
            <li>Fecha y hora exacta de cada movimiento</li>
            <li>Activos prestados o devueltos</li>
            <li>Estado de los equipos (con evidencia fotográfica)</li>
            <li>Firma digital de aceptación</li>
        </ul>

        <h2 class="text-lg font-semibold">5. Derechos del Titular</h2>
        <ul class="list-disc list-inside">
            <li>Conocer, actualizar y rectificar sus datos</li>
            <li>Solicitar prueba de esta autorización</li>
            <li>Revocar el consentimiento (salvo deber legal)</li>
            <li>Presentar reclamos ante la Superintendencia de Industria y Comercio</li>
            <li>Acceder a información sobre el uso de sus datos</li>
        </ul>

        <h2 class="text-lg font-semibold">6. Seguridad y Conservación</h2>
        <h3 class="font-semibold">6.1 Medidas de Protección</h3>
        <ul class="list-disc list-inside">
            <li>Encriptación de datos sensibles</li>
            <li>Controles de acceso por roles</li>
            <li>Auditorías periódicas de seguridad</li>
            <li>Copias de seguridad automatizadas</li>
        </ul>

        <h3 class="font-semibold">6.2 Tiempos de Conservación</h3>
        <x-tabla-conservacion />

        <h2 class="text-lg font-semibold">7. Aspectos Legales</h2>
        <ul class="list-disc list-inside">
            <li>Ley 1581 de 2012 (Protección de Datos)</li>
            <li>Decreto 1074 de 2015 (Reglamentario)</li>
            <li>Políticas institucionales SENA</li>
            <li>Estándares ISO 27001 de seguridad</li>
        </ul>
        <p>El incumplimiento de las políticas puede generar medidas institucionales y, en casos graves que configuren
            conductas delictivas, acciones legales conforme a la normativa colombiana vigente.</p>

        <h3 class="font-semibold">Declaración de Aceptación</h3>
        <p><em>"Declaro que he sido informado sobre los términos de este acuerdo y comprendo que el sistema registra
                evidencia digital de mis transacciones. Autorizo al SENA para el tratamiento de mis datos personales
                conforme a lo establecido, comprometiéndome a utilizar los activos institucionales de manera
                responsable."</em></p>
        <p><strong>Al marcar "Acepto el tratamiento de datos personales según lo establecido", reconozco haber leído y comprendido este acuerdo
                completo.</strong></p>

        <p class="mt-6 text-xs text-center text-gray-500">
            <strong>Documento probatorio:</strong> Su aceptación se registrará con fecha, hora y dirección IP<br>
            Para ejercer sus derechos, contacte a: servicioalciudadano@sena.edu.co<br>
            Sistema Integrado de Gestión y Autocontrol | GOR-POL-006 V01
        </p>
    </div>
    <!-- NUEVA SECCIÓN DE BOTONES -->
 <div class="flex justify-center mt-8 space-x-4">
            <a href="{{ route('login') }}"
               class="inline-block px-6 py-2 text-white transition bg-green-700 border border-green-700 rounded-lg hover:bg-green-800">
                Iniciar sesión
            </a>
            <a href="{{ route('register') }}"
               class="inline-block px-6 py-2 text-green-700 transition border border-green-700 rounded-lg hover:bg-green-50">
                Registrarse
            </a>
        </div>

@endsection
