<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments of the current users.
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
     * Show the form page for creating a new appointment.
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
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $this->authorize('create', Appointment::class);
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
        $message = "Avec Dr. {$doctor->name} est confirmé pour le {$appointmentDate->format('d/m/Y H:i')}.";
        $subject = "Confirmation de rendez-vous";
        $toEmail = 'mael315mael@gmail.com';

        Mail::to($toEmail)->send(new ReservationConfirmation(
            $message,$subject
        ));

        return redirect()->route('home')
            ->with('success', 'Appointment booked successfully!');
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
        if ($appointment->date->diffInHours(now()) < 24 && auth()->user()->rank === 0) {
            return redirect()->route('appointments.index')
                ->with('error', 'You cannot cancel an appointment less than 24 hours before the scheduled time.');
        }

        if ($appointment->client_id !== auth()->id() && auth()->user()->rank === 0) {
            return redirect()->route('appointments.index')
                ->with('error', 'You are not authorized to cancel this appointment.');
        }

        $appointment->delete();

        return redirect()->route('home')
            ->with('success', 'Appointment cancelled successfully.');
    }
}
