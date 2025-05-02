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
        Schema::table('veterinarian_profiles', function (Blueprint $table) {
            // Remove old clinic_name column
            $table->dropColumn('clinic_name');
            $table->dropColumn('location');

            // Add foreign key to vet_clinics
            $table->foreignId('vet_clinic_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veterinarian_profiles', function (Blueprint $table) {
            // Rollback: re-add clinic_name and remove vet_clinic_id
            $table->string('clinic_name')->nullable();
            $table->string('location')->nullable();
            $table->dropForeign(['vet_clinic_id']);
            $table->dropColumn('vet_clinic_id');

        });
    }
};
