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

        return [
            'asset_id' => ['required', 'exists:assets,id'],
            'start_date' => [
                'required', 'date',
                'after_or_equal:today',
                'before_or_equal:' . now()->addDays(3)->format('Y-m-d')
            ],
            'end_date' => [
                'required', 'date',
                'after_or_equal:start_date',
                'before_or_equal:' . Carbon::parse($start)->addDays(1)->format('Y-m-d')
            ],
            'delivery_hour' => [
                'required', 'date_format:H:i',
                'after_or_equal:07:00',
                'before_or_equal:18:00'
            ],
            'notes' => ['nullable', 'string', 'max:1000']
        ];
    }
}

