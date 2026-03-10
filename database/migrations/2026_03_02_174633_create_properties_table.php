<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description_poetic');
            
            // Finances CFA
            $table->unsignedBigInteger('price'); 
            $table->string('currency')->default('XOF'); 
            $table->boolean('is_off_market')->default(false);
            
            // Détails du bien
            $table->string('city');
            $table->string('district')->nullable();
            $table->decimal('surface_m2', 10, 2);
            $table->integer('rooms');
            
            // Statut & Extras
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available');
            $table->json('amenities')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};