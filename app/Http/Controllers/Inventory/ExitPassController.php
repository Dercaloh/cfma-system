<?php
/// app/Http/Controllers/ExitPassController.php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Assets\ExitPass;

class ExitPassController extends Controller
{
    use AuthorizesRequests;

    public function show(ExitPass $exitPass)
    {
        $this->authorize('view', $exitPass); // requiere política opcional

        return view('exit_passes.show', compact('exitPass'));
    }

    public function generatePDF(ExitPass $exitPass)
    {
        $this->authorize('view', $exitPass);

        $pdf = Pdf::loadView('exit_passes.template', compact('exitPass'));
        $filePath = 'actas/exitpass_' . $exitPass->id . '.pdf';

        Storage::disk('public')->put($filePath, $pdf->output());
        $exitPass->update(['archivo_pdf' => $filePath]);

        return response()->file(storage_path('app/public/' . $filePath));
    }
}


