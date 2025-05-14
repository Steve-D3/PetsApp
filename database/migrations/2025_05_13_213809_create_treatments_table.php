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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g. "Antibiotic injection", "Wound cleaning"
            $table->string('category')->nullable(); // e.g. "Medication", "Procedure", "Surgery", "Diagnostic"
            $table->text('description')->nullable();
            $table->decimal('cost', 8, 2)->nullable(); // Billing info
            $table->decimal('quantity', 8, 2)->default(1.00); // For multiple units (e.g. 2 injections)
            $table->string('unit')->nullable(); // e.g. "injection", "treatment", "hour"
            $table->boolean('completed')->default(true); // Track if treatment was completed
            $table->dateTime('administered_at')->nullable(); // When treatment was administered
            $table->foreignId('administered_by')->nullable()->constrained('users')->onDelete('set null'); // Who administered it
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
        Schema::dropIfExists('treatment_types');
    }
};
