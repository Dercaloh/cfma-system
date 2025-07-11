{{-- Documentos Asociados --}}
@if ($asset->documents->count())
    <div class="space-y-4">
        <ul class="space-y-3 text-sm">
            @foreach ($asset->documents as $doc)
                <li class="flex justify-between items-center bg-gray-50 p-3 rounded border">
                    <div>
                        <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="text-blue-600 hover:underline font-medium">
                            {{ $doc->filename }}
                        </a>
                        @if ($doc->description)
                            <p class="text-gray-500">{{ $doc->description }}</p>
                        @endif
                    </div>
                    <span class="text-xs text-gray-400">
                        {{ \Illuminate\Support\Carbon::parse($doc->created_at)->format('d/m/Y') }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@can('update', $asset)
    {{-- Formulario para subir documentos --}}
    <div class="mt-6 pt-4 border-t space-y-4">
        <h3 class="text-lg font-semibold">📤 Subir nuevo documento</h3>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('documentos.store', $asset) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold">Archivo *</label>
                <input type="file" name="file" required class="w-full border border-gray-300 rounded px-3 py-2">
                <p class="text-xs text-gray-500 mt-1">PDF, DOCX, XLSX, JPG, PNG (máx. 2MB)</p>
            </div>

            <div>
                <label class="block text-sm font-semibold">Descripción</label>
                <input type="text" name="description" maxlength="255" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                Subir Documento
            </button>
        </form>
    </div>
@endcan
