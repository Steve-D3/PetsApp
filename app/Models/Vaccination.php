<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    /** @use HasFactory<\Database\Factories\VaccinationFactory> */
    use HasFactory;

    public function vaccinationType()
    {
        return $this->belongsTo(VaccineType::class, 'vaccine_type_id');
    }
}
