<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the appointments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Appointment::class);
        $appointments = Appointment::where('client_id', auth()->id())
            ->with(['schedule', 'doctor'])
            ->orderBy('date', 'asc')
            ->get();
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = User::where('rank', 1)->get();
        return view('appointments.create', compact('doctors'));
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $validated = $request->validated();
        $doctor = User::findOrFail($validated['doctor_id']);

        $appointmentDate = Carbon::parse($validated['date'])->setSecond(0);
        $minutes = $appointmentDate->minute;
        $roundedMinutes = round($minutes / 30) * 30;
        $appointmentDate->minute = $roundedMinutes;

        $schedule = Schedule::create([
            'day' => $appointmentDate->toDateString(),
            'hour_start' => $appointmentDate->format('H:i:s'),
            'hour_end' => $appointmentDate->copy()->addMinutes(30)->format('H:i:s'),
        ]);

        $appointment = Appointment::create([
            'client_id' => auth()->id(),
            'schedule_id' => $schedule->id,
            'date' => $appointmentDate,
            'type' => $validated['type'],
            'client_note' => $validated['client_note'] ?? '',
            'status' => false,
            'doctor_name' => $doctor->name,
        ]);

        return redirect()->route('home')
            ->with('success', 'Appointment booked successfully!');
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
        $this->authorize('delete', $appointment);
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment cancelled successfully.');
    }
}
