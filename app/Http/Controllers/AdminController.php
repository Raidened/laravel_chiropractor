<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorize('viewAnyAdmin', Appointment::class);

        $appointments = Appointment::all();


        return view('admin', compact('appointments'));
    }

    public function modify(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'hour_start' => 'required',
            'hour_end' => 'required'
        ]);

        $appointment = Appointment::findOrFail($id);
        $schedule = $appointment->schedule;

        $schedule->update([
            'day' => $request->date,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end
        ]);
        return redirect()->route('admin.index')->with('success', 'Schedule updated successfully.');
    }

    public function modifyStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.index')->with('success', 'Status updated successfully.');

    }

}
