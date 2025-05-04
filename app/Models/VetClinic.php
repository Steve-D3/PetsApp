<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VetClinic extends Model
{
    /** @use HasFactory<\Database\Factories\VetClinicFactory> */
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function veterinarians()
{
    return $this->hasMany(VeterinarianProfile::class, 'vet_clinic_id');
}
}
