<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('veterinarian_profile_id')->constrained('veterinarian_profiles')->cascadeOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete("set null");
            $table->dateTime('record_date')->default(now());
            $table->string('chief_complaint');
            $table->text('history')->nullable();
            $table->text('physical_examination');
            $table->text('diagnosis');
            $table->text('treatment_plan')->nullable();
            $table->text('medications')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
