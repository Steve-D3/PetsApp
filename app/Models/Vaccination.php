<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    /** @use HasFactory<\Database\Factories\VaccinationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pet_id',
        'medical_record_id',
        'vaccine_type_id',
        'manufacturer',
        'batch_number',
        'serial_number',
        'expiration_date',
        'administration_date',
        'next_due_date',
        'administered_by',
        'administration_site',
        'administration_route',
        'dose',
        'dose_unit',
        'is_booster',
        'certification_number',
        'reaction_observed',
        'reaction_details',
        'notes',
        'cost',
        'reminder_sent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expiration_date' => 'date',
        'administration_date' => 'date',
        'next_due_date' => 'date',
        'is_booster' => 'boolean',
        'reaction_observed' => 'boolean',
        'reminder_sent' => 'boolean',
        'dose' => 'float',
        'cost' => 'float',
    ];

    /**
     * Get the vaccination type associated with the vaccination.
     */
    public function vaccinationType()
    {
        return $this->belongsTo(VaccineType::class, 'vaccine_type_id');
    }
}
