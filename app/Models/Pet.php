<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /** @use HasFactory<\Database\Factories\PetFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'photo',
        'microchip_number',
        'sterilized',
        'species',
        'breed',
        'gender',
        'weight',
        'birth_date',
        'allergies',
        'food_preferences',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
