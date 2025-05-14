<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    /** @use HasFactory<\Database\Factories\MedicalRecordFactory> */
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'veterinarian_profile_id',
        'appointment_id',
        'record_date',
        'chief_complaint',
        'history',
        'physical_examination',
        'diagnosis',
        'treatment_plan',
        'medications',
        'notes',
        'weight',
        'temperature',
        'heart_rate',
        'respiratory_rate',
        'follow_up_required',
        'follow_up_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pet_id',
        'veterinarian_profile_id',
        'appointment_id',
    ];

    public function pet(){
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function vet(){
        return $this->belongsTo(VeterinarianProfile::class, 'veterinarian_profile_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function treatments(){
        return $this->hasMany(Treatment::class, 'medical_record_id');
    }

    public function vaccinations(){
        return $this->hasMany(Vaccination::class, 'medical_record_id', 'id');
    }
}
