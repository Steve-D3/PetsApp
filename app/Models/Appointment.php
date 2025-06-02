<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'veterinarian_id',
        'start_time',
        'end_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class)->with('medicalRecords');
    }

    public function veterinarian()
    {
        return $this->belongsTo(VeterinarianProfile::class, 'veterinarian_id', 'user_id')->with('clinic', 'user');
    }

    public function clinic()
    {
        return $this->belongsTo(VetClinic::class, 'clinic_id');
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'pet_id', 'pet_id')->with('vaccinationType');
    }
}
