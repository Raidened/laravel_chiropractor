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
        'created_at',
        'updated_at',
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
