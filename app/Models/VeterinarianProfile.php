<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeterinarianProfile extends Model
{
    /** @use HasFactory<\Database\Factories\VeterinarianProfileFactory> */
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'vet_clinic_id',
    ];

    protected $casts = [
        'off_days' => 'array',
    ];

    public function clinic()
    {
        return $this->belongsTo(VetClinic::class, 'vet_clinic_id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'veterinarian_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'veterinarian_id', 'user_id');
    }
}
