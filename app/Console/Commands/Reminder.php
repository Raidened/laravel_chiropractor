<?php

namespace App\Console\Commands;

use App\Mail\ReservationConfirmation;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Reminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($now)));

        $appointments = Appointment::whereBetween('date', [$now, $tomorrow])->get();

        foreach ($appointments as $appointment) {
            $doctor = $appointment->doctor_name;
            $appointmentDate = date('d/m/Y H:i', strtotime($appointment->date));
            $toEmail = 'mael315mael@gmail.com';

            $message = "Rappel : Vous avez un rendez-vous avec Dr. {$doctor} prévu pour le {$appointmentDate}.";
            $subject = "Rappel de rendez-vous";

            Mail::to($toEmail)->send(new ReservationConfirmation($message, $subject));
        }

    }
}
