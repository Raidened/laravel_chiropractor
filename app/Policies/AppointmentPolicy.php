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

    public function viewAnyAdmin(User $user): bool
    {
        if ($user->rank === 1) {
            return true;
        }
        return false;
    }

    public function create(User $user)
    {
        return $user->rank === 0;
    }

    public function update(User $user)
    {
        return $user->rank ===1;
    }

    public function delete(User $user, Appointment $appointment)
    {
        if ($user->rank === 1) {
            return true;
        }
        return $user->id === $appointment->client_id  &&
               $appointment->date->diffInHours(now()) >= 24;
    }
}
