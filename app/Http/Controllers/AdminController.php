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
            'date-day' => 'required|date',
        ]);

        $appointment = Appointment::findOrFail($id);
        $schedule = $appointment->schedule;

        $schedule->update([
            'day' => $request->date,
        ]);

        return redirect()->route('admin.index')->with('success', 'Schedule updated successfully.');
    }
}
