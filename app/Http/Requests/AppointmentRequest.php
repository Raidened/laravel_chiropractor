<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'schedule_id' => ['required', 'exists:schedules,id'],
            'type' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'schedule_id.required' => 'Veuillez sélectionner un créneau horaire',
            'schedule_id.exists' => 'Le créneau horaire sélectionné n\'est pas disponible',
            'type.required' => 'Veuillez préciser le type de consultation',
        ];
    }
}
