<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineType extends Model
{
    /** @use HasFactory<\Database\Factories\VaccineTypeFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'for_species',
        'description',
        'default_validity_period',
        'is_required_by_law',
        'minimum_age_days',
        'administration_protocol',
        'common_manufacturers',
        'requires_booster',
        'booster_waiting_period',
        'default_administration_route',
        'default_cost',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_required_by_law' => 'boolean',
        'requires_booster' => 'boolean',
        'default_cost' => 'float',
    ];

    /**
     * Get the vaccinations associated with this vaccine type.
     */
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'vaccine_type_id');
    }
}
