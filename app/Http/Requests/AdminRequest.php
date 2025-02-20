<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        return [
            'date' => 'date',
            'hour_start' => 'date_format:H:i',
            'hour_end' => 'date_format:H:i|after:hour_start',
            'status' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'date.date' => 'Veuillez sélectionner une date',
            'hour_end.after' => 'Veuillez sélectionner une heure de fin',
            'hour_start.date_format' => 'Veuillez sélectionner une heure de début',
            'hour_end.date_format' => 'Veuillez sélectionner une heure de fin',
            'status.string' => 'Veuillez sélectionner un statut',
        ];


    }
}
