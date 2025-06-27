{{-- Actas de salida asociadas --}}
@if($asset->exitPasses->count())
    <div class="space-y-4">
        {{-- Buscador simple --}}
        <input type="text" placeholder="Buscar cuentadante..." class="w-full p-2 border border-gray-300 rounded" oninput="filtrarActas(this.value)">

        <ul id="lista-actas" class="space-y-3 text-sm">
            @foreach ($asset->exitPasses as $pass)
                <li class="acta-item flex justify-between items-center bg-gray-50 p-3 rounded border">
                    <div>
                        <p class="font-semibold text-gray-700">{{ $pass->cuentadante }}</p>
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($pass->autorizado_salida)->format('d/m/Y H:i') }}</p>
                        <p class="text-gray-500 italic">{{ $pass->dependencia }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('exit_passes.show', $pass) }}" target="_blank" class="text-blue-600 hover:underline">Vista previa</a>
                        <a href="{{ route('exit_passes.pdf', $pass) }}" target="_blank" class="text-green-600 hover:underline">PDF</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        function filtrarActas(valor) {
            valor = valor.toLowerCase();
            document.querySelectorAll('.acta-item').forEach(el => {
                el.style.display = el.textContent.toLowerCase().includes(valor) ? 'flex' : 'none';
            });
        }
    </script>
@endif
