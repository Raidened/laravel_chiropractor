<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'schedule_id',
        'client_id',
        'client_note',
        'status',
        'doctor_name',
        'type'
    ];
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
