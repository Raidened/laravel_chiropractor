<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->rank === 0;
    }

    public function rules()
    {
        return [
            'doctor_id' => ['required', 'exists:users,id,rank,1'],
            'date' => [
                'required',
                'date',
                'after:now',
                function($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isWeekend()) {
                        $fail('Appointments are not available on weekends.');
                    }
                    if ($date->hour < 9 || $date->hour >= 18) {
                        $fail('Appointments are only available between 9:00 and 18:00.');
                    }
                }
            ],
            'type' => ['required', 'string', 'max:255'],
            'client_note' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
