<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class Verifappoointment extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'client_id' => 'required|exists:users,id',
            'client_note' => 'nullable|string',
            'status' => 'required|boolean',
            'doctor_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $doctor = User::find($value);
                    if (!$doctor || $doctor->rank != 1) {
                        $fail("Le docteur sélectionné n'a pas le rang requis.");
                    }
                }
            ],
            'type' => 'required|string',
        ]);

        $appointment = Appointment::create($request->all());

        return view('appointments.show', ['appointment' => $appointment]);

    }
}

