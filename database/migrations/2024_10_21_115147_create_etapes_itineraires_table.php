<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('etapes_itineraires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itineraire_id')->constrained('itineraires')->onDelete('cascade');
            $table->string('nom_etape');
            $table->text('description_etape')->nullable();
            $table->integer('ordre_etape');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapes_itineraires');
    }
};
