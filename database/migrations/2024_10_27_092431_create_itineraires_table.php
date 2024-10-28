<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('itineraires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destination')->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->integer('duree'); // e.g. duration in hours or days
            $table->decimal('prix', 8, 2); // e.g. price with 2 decimal points
            $table->enum('difficulte', ['facile', 'moyenne', 'difficile']); // difficulty levels
            $table->decimal('impact_carbone', 8, 2); // carbon impact, if needed
            $table->string('image_url')->nullable(); // image url if needed
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraires');
    }
};
