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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('microchip_number')->nullable();
            $table->boolean('sterilized')->default(false);
            $table->string('species');
            $table->string('breed')->nullable();
            $table->string('gender')->nullable();
            $table->float('weight');
            $table->date('birth_date')->nullable();
            $table->text('allergies')->nullable();
            $table->text('food_preferences')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
