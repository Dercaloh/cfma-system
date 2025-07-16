@props([
    'version' => '1.0.0',
    'vigenteDesde' => '03/Julio/2023',
    'formulario' => false
])

<x-cards.card-glass subtitle="Versión {{ $version }} - Vigente desde {{ $vigenteDesde }}">
    <div class="space-y-8 text-sm leading-relaxed text-gray-800 privacy-policy">

        {{-- 1. Responsable del Tratamiento --}}
        <section>
            <h2 class="text-lg font-semibold">1. Responsable del Tratamiento</h2>
            <p>El <strong>SERVICIO NACIONAL DE APRENDIZAJE - SENA</strong>, identificado con NIT 899.999.034-1, con domicilio en Calle 57 No. 8-69, Bogotá D.C., es el responsable del tratamiento de sus datos personales.</p>
            <ul class="mt-2 list-disc list-inside">
                <li><strong>Contacto:</strong> servicioalciudadano@sena.edu.co</li>
                <li><strong>Teléfono:</strong> (601) 546 1500 ext. 12453 - 13006</li>
                <li><strong>Política completa:</strong>
                    <a href="https://compromiso.sena.edu.co/mapa/descarga.php?id=3628"
                       target="_blank"
                       class="underline text-sena-azul">Consultar política de datos</a>
                </li>
            </ul>
        </section>

        {{-- 2. Finalidades del Tratamiento --}}
        <section>
            <h2 class="text-lg font-semibold">2. Finalidades del Tratamiento</h2>
            <p>Sus datos serán utilizados para:</p>
            <x-legal.tabla-finalidades />
        </section>

        {{-- 3. Datos Personales Recolectados --}}
        <section>
            <h2 class="text-lg font-semibold">3. Datos Personales Recolectados</h2>
            <p>Recolectamos únicamente los datos necesarios para las finalidades descritas:</p>
            <x-legal.tabla-datos-personales />
        </section>

        {{-- 4. Gestión de Activos --}}
        <section>
            <h2 class="text-lg font-semibold">4. Gestión de Activos</h2>
            <p>Al usar el sistema de préstamos, acepta:</p>
            <ul class="list-disc list-inside">
                <li>Los registros digitales son prueba válida de transacciones</li>
                <li>Es responsable de los activos durante el período de préstamo</li>
                <li>Debe reportar anomalías dentro de 24 horas tras el check-in</li>
                <li>El SENA implementa medidas de seguridad razonables</li>
            </ul>

            <h3 class="mt-4 font-semibold">4.1 Proceso de Check-in/Check-out</h3>
            <ul class="list-disc list-inside">
                <li>Fecha y hora exacta de cada movimiento</li>
                <li>Activos prestados o devueltos</li>
                <li>Estado de los equipos (con evidencia fotográfica)</li>
                <li>Firma digital de aceptación</li>
            </ul>
        </section>

        {{-- 5. Derechos del Titular --}}
        <section>
            <h2 class="text-lg font-semibold">5. Derechos del Titular</h2>
            <ul class="list-disc list-inside">
                <li>Conocer, actualizar y rectificar sus datos</li>
                <li>Solicitar prueba de esta autorización</li>
                <li>Revocar el consentimiento (salvo deber legal)</li>
                <li>Presentar reclamos ante la Superintendencia de Industria y Comercio</li>
                <li>Acceder a información sobre el uso de sus datos</li>
            </ul>
        </section>

        {{-- 6. Seguridad y Conservación --}}
        <section>
            <h2 class="text-lg font-semibold">6. Seguridad y Conservación</h2>
            <h3 class="font-semibold">6.1 Medidas de Protección</h3>
            <ul class="list-disc list-inside">
                <li>Encriptación de datos sensibles</li>
                <li>Controles de acceso por roles</li>
                <li>Auditorías periódicas de seguridad</li>
                <li>Copias de seguridad automatizadas</li>
            </ul>

            <h3 class="mt-4 font-semibold">6.2 Tiempos de Conservación</h3>
            <x-legal.tabla-conservacion />
        </section>

        {{-- 7. Aspectos Legales --}}
        <section>
            <h2 class="text-lg font-semibold">7. Aspectos Legales</h2>
            <ul class="list-disc list-inside">
                <li>Ley 1581 de 2012 (Protección de Datos)</li>
                <li>Decreto 1074 de 2015 (Reglamentario)</li>
                <li>Políticas institucionales SENA</li>
                <li>Estándares ISO 27001 de seguridad</li>
            </ul>
            <p class="mt-2">El incumplimiento de las políticas puede generar medidas institucionales y, en casos graves, acciones legales conforme a la normativa colombiana vigente.</p>
        </section>

        {{-- Declaración de Aceptación --}}
        <section>
            <h3 class="font-semibold">Declaración de Aceptación</h3>
            <p class="italic">"Declaro que he sido informado sobre los términos de este acuerdo y comprendo que el sistema registra evidencia digital de mis transacciones. Autorizo al SENA para el tratamiento de mis datos personales conforme a lo establecido, comprometiéndome a utilizar los activos institucionales de manera responsable."</p>
            <p class="mt-2 font-semibold">Al marcar "Acepto el tratamiento de datos personales según lo establecido", reconozco haber leído y comprendido este acuerdo completo.</p>

            @if ($formulario)
                <form method="POST"
                      action="{{ route('politicas.store') }}"
                      class="mt-6 text-center"
                      onsubmit="this.querySelector('button').disabled = true;"
                >
                    @csrf
                    <input type="hidden" name="policy_name" value="data_protection">
                    <input type="hidden" name="policy_version" value="{{ $version }}">

                    <x-buttons.primary-button
                        type="submit"
                        aria-describedby="data-policy-context"
                    >
                        Acepto el tratamiento de datos personales según lo establecido
                    </x-buttons.primary-button>

                    <span class="block mt-2 text-xs text-gray-500">
                        Se registrará: {{ now()->format('d/m/Y H:i') }} desde la IP {{ request()->ip() }}
                    </span>
                </form>
            @endif

            <p id="data-policy-context" class="mt-6 text-xs text-center text-gray-500">
                <strong>Documento probatorio:</strong> Su aceptación se registrará con fecha, hora y dirección IP<br>
                Para ejercer sus derechos, contacte a: servicioalciudadano@sena.edu.co<br>
                Sistema Integrado de Gestión y Autocontrol | GOR-POL-006 V01
            </p>
        </section>
    </div>
</x-cards.card-glass>
