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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->foreignId('medical_record_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('vaccine_type_id')->constrained()->onDelete('restrict'); // Reference to vaccine_types
            $table->string('manufacturer')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('expiration_date')->nullable();
            $table->date('administration_date');
            $table->date('next_due_date')->nullable();
            $table->foreignId('administered_by')->nullable()->constrained('veterinarian_profiles')->onDelete('set null');
            $table->string('administration_site')->nullable();
            $table->string('administration_route')->nullable();
            $table->decimal('dose', 8, 2)->nullable();
            $table->string('dose_unit')->nullable();
            $table->boolean('is_booster')->default(false);
            $table->string('certification_number')->nullable();
            $table->boolean('reaction_observed')->default(false);
            $table->text('reaction_details')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('cost', 8, 2)->nullable();
            $table->boolean('reminder_sent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
