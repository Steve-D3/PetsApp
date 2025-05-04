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
        'scheduled_at',
        'status',
        'notes',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(VeterinarianProfile::class, 'id');
    }
}
