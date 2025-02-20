<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\http\Requests\AdminRequest;
class AdminController extends Controller
{
    public function index()
    {
        $this->authorize('viewAnyAdmin', Appointment::class);

        $appointments = Appointment::all();


        return view('admin', compact('appointments'));
    }

    public function modify(AdminRequest $request, $id)
    {

        $this->authorize('update', Appointment::class);

        $appointment = Appointment::findOrFail($id);
        $schedule = $appointment->schedule;

        $schedule->update([
            'day' => $request->date,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end
        ]);
        return redirect()->route('admin.index')->with('success', 'Schedule updated successfully.');
    }

    public function modifyStatus(AdminRequest $request, $id)
    {
        $this->authorize('update', Appointment::class);


        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.index')->with('success', 'Status updated successfully.');

    }

}
