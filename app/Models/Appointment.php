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
        'type',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime',
        'status' => 'boolean'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_name', 'name')
            ->where('rank', 1);
    }
}
