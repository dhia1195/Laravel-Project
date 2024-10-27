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
        
        Schema::create('hebergements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('type');
            $table->string('adresse');
            $table->string('pays');
            $table->string('ville');
            $table->decimal('prix_nuit', 10, 2);
            $table->string('impact_environnemental');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    
      
    public function down(): void
    {
        Schema::dropIfExists('hebergements');
    }
};
