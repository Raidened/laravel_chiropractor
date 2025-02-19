<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'hour_start',
        'hour_end',
    ];

    protected $casts = [
        'day' => 'date',
        'hour_start' => 'datetime',
        'hour_end' => 'datetime',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
