<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreatmentType extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'default_cost',
        'default_unit'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // Relationship with treatments (optional)
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
