<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alert_area_cords', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alert_area_id');
            $table->decimal('lat',11, 8)->nullable()->default(NULL);
            $table->decimal('lng', 11, 8)->nullable()->default(NULL);
            $table->integer('teryt_district')->nullable()->default(NULL);
            $table->integer('teryt_commune')->nullable()->default(NULL);
            $table->integer('teryt_city')->nullable()->default(NULL);
            $table->integer('teryt_street')->nullable()->default(NULL);
            $table->timestamps();

            $table->foreign('alert_area_id')->references('id')->on('alert_areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_area_cords');
    }
};
