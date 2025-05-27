<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\VetClinic;
use App\Models\Pet;
use App\Models\Appointment;

class VeterinarianProfile extends Model
{
    /** @use HasFactory<\Database\Factories\VeterinarianProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'specialty',
        'biography',
        'phone_number',
        'vet_clinic_id',
        'off_days',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'vet_clinic_id',
    ];

    protected $casts = [
        'off_days' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clinic()
    {
        return $this->belongsTo(VetClinic::class, 'vet_clinic_id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'veterinarian_id');
    }

    /**
     * Get the appointments for the veterinarian.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'veterinarian_id', 'user_id');
    }
}
