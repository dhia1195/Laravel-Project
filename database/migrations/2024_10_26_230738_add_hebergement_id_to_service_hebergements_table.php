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
        Schema::table('service_hebergements', function (Blueprint $table) {
            $table->unsignedBigInteger('hebergement_id')->after('id'); // Adjust position as necessary
        
            // Optionally, add foreign key constraint if needed
            $table->foreign('hebergement_id')->references('id')->on('hebergements')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_hebergements', function (Blueprint $table) {
            $table->dropForeign(['hebergement_id']);
            $table->dropColumn('hebergement_id');
        });
    }
};
