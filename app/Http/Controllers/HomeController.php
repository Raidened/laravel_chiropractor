<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $selectedDoctorId = $request->input('doctor_id');
        
        $query = Appointment::query();
        
        if ($selectedDoctorId) {
            $doctor = User::find($selectedDoctorId);
            if ($doctor) {
                $query->where('doctor_name', $doctor->name);
            }
        }

        $events = $query->get()->map(function($appointment) {
            return [
                'title' => $appointment->type,
                'doctor_name' => $appointment->doctor_name,
                'status' => $appointment->status,
                'client_note' => $appointment->client_note,
                'start' => Carbon::parse($appointment->date)->format('Y-m-d\TH:i:s'),
                'end' => Carbon::parse($appointment->date)->addMinutes(30)->format('Y-m-d\TH:i:s'),
                'color' => $appointment->status ? '#28a745' : '#ffc107'
            ];
        })->toArray();

        $doctors = User::where('rank', 1)->get();
        return view('home', compact('events', 'doctors', 'selectedDoctorId'));
    }
}
