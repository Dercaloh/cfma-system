<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request, Asset $asset)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xlsx|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');

    // 📁 NUEVA RUTA ESCALABLE
        $path = $file->store("documents/assets/{$asset->id}", 'public');

        $asset->documents()->create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => $file->getClientMimeType(),
            'description' => $request->input('description'),
        ]);

        return redirect()
            ->route('inventario.show', $asset)
            ->with('success', 'Documento subido exitosamente.');
    }


}
