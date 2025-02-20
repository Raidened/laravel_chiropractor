<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     *
     * @return \Illuminate\Http\Response
     */




    /**
     * Show the form for creating a new appointment.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $this->authorize('viewAny', Appointment::class);
        $doctors = User::where('rank', 1)->get();
        return view('appointments.create', compact('doctors'));
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date|unique:appointments,date',
            'type' => 'required|string',
            'client_note' => 'nullable|string',
        ]);

        $doctor = User::findOrFail($request->doctor_id);
        $appointmentDate = \Carbon\Carbon::parse($request->date)->format('Y-m-d H:i:00');

        Appointment::create([
            'client_id' => auth()->id(),
            'date' => $appointmentDate,
            'type' => $request->type,
            'client_note' => $request->client_note ?? '',
            'status' => false, // Pending by default
            'doctor_name' => $doctor->name,
        ]);

        return redirect()->route('home')->with('success', 'Appointment booked successfully!');
    }

    /**
     * Display the specified appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'date' => 'required|date',
            'type_of_consultation' => 'required|string',
        ]);

        $appointment->update([
            'date' => $request->date,
            'type_of_consultation' => $request->type_of_consultation,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified appointment from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.index')->with('success', 'Appointment deleted successfully');
    }
}
