<?php
/**
 * StoreLoanRequest.php
 *
 * This file contains the validation rules for storing a loan request.
 *
 * @package App\Http\Requests
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $start = $this->start_date ?? now()->format('Y-m-d');

        $rules = [
            'asset_id'      => ['required', 'exists:assets,id'],
            'tipo_de_uso'   => ['required', Rule::in(['formativo', 'administrativo'])],
            'cantidad'      => ['required', 'integer', 'min:1'],
            'sede'          => ['required', 'string', 'max:255'],
            'hora_entrega'  => ['required', 'date_format:H:i', 'after_or_equal:07:00', 'before_or_equal:18:00'],
            'notes'         => ['nullable', 'string', 'max:1000'],
        ];

        if ($this->tipo_de_uso === 'formativo') {
            $rules += [
                'ficha'       => ['required', 'string', 'max:50'],
                'programa'    => ['required', 'string', 'max:255'],
                'instructor'  => ['required', 'string', 'max:255'],
            ];
        } else {
            $rules += [
                'cargo'         => ['required', 'string', 'max:255'],
                'departamento'  => ['required', 'string', 'max:255'],
                'proposito'     => ['required', 'string', 'max:500'],
            ];
        }

        return $rules;
    }
}
