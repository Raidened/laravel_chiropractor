<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;

class EmailController extends Controller
{
    public function SendEmail(){
        $toEmail = 'mael315mael@gmail.com';
        $message = 'test mail';
        $subject = 'test mail';

        $response = Mail::to($toEmail)->send(new ReservationConfirmation($message, $subject));

        dd($response);
    }
}
