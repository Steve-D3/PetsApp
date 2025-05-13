<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'medical_record_id',
        'name',
        'category',
        'description',
        'cost',
        'quantity',
        'unit',
        'completed',
        'administered_at',
        'administered_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'cost' => 'decimal:2',
        'quantity' => 'decimal:2',
        'completed' => 'boolean',
        'administered_at' => 'datetime',
    ];

    /**
     * Get the medical record that this treatment belongs to.
     */
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    /**
     * Get the user who administered this treatment.
     */
    public function administrator()
    {
        return $this->belongsTo(User::class, 'administered_by');
    }

    /**
     * Get the total cost of this treatment.
     *
     * @return float
     */
    public function getTotalCostAttribute()
    {
        return $this->cost * $this->quantity;
    }

    /**
     * Scope a query to only include treatments of a given category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to only include completed treatments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Scope a query to only include pending treatments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('completed', false);
    }
}
