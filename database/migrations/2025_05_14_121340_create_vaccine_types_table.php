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
        Schema::create('vaccine_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the vaccine (e.g., Rabies, DHPP, FVRCP)
            $table->string('category'); // Core, Non-core, etc.
            $table->string('for_species'); // Dog, Cat, Both, Exotic, etc.
            $table->text('description')->nullable(); // Description of what the vaccine prevents
            $table->integer('default_validity_period')->nullable(); // Default validity in days
            $table->boolean('is_required_by_law')->default(false); // Whether legally required (e.g., Rabies)
            $table->integer('minimum_age_days')->nullable(); // Minimum age for first administration
            $table->text('administration_protocol')->nullable(); // General instructions for administration
            $table->string('common_manufacturers')->nullable(); // Comma-separated list of common manufacturers
            $table->boolean('requires_booster')->default(false); // Whether a booster is typically needed
            $table->integer('booster_waiting_period')->nullable(); // Days until booster typically given
            $table->string('default_administration_route')->nullable(); // Typical administration route
            $table->decimal('default_cost', 8, 2)->nullable(); // Default/suggested cost
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_types');
    }
};
