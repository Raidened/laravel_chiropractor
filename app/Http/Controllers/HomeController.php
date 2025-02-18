<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

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
    public function index()
    {
        return view('home');
    }

    public function calendar()
    {
        $events = array();
        $bookings = Appointment::all();
        foreach ($bookings as $booking) {
            $events[] = [
                'date'=>$booking->date,
                'client_note'=>$booking->client_note,
                'status'=>$booking->status,
                'doctor_name'=>$booking->doctor_name,
                'type'=>$booking->type,
            ];
        }
        return view('home', compact('events'));
    }






}
