'<?php

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
        Schema::create('transport_itineraires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destination')->onDelete('cascade');
            $table->foreignId('transport_id')->constrained('transports')->onDelete('cascade');
            $table->integer('distance');
            $table->integer('duree');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_itineraires');
    }
};
