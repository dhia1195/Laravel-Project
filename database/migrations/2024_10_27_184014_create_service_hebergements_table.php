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
        Schema::create('service_hebergements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hebergement_id')->constrained('hebergements')->onDelete('cascade');
            $table->string('service_nom');
            $table->text('description');
            $table->boolean('disponibilite'); // boolean as per validation
            $table->decimal('prix_service', 8, 2); // matches validation 'prix_service'
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_hebergements');
    }
};
