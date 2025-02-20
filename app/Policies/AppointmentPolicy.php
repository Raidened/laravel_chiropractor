<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Auth\Access\HandlerContract;

class AppointmentPolicy
{
    public function viewAny(User $user)
    {
        if($user->rank === 0) {
            return true;
        }
        return false;
    }

    public function view(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->client_id || $user->rank === 1;
    }

    public function create(User $user)
    {
        return $user->rank === 0;
    }

    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->client_id;
    }

    public function delete(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->client_id &&
               $appointment->date->diffInHours(now()) >= 24;
    }
}
