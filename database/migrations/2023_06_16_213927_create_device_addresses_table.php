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
        Schema::create('device_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->string('street')->nullable()->default(NULL);
            $table->string('number')->nullable()->default(NULL);
            $table->string('city')->default('Otwock');
            $table->decimal('latitude',11, 8)->nullable()->default(NULL);
            $table->decimal('longitude',11, 8)->nullable()->default(NULL);
            $table->integer('teryt_province')->default(14);
            $table->integer('teryt_district')->default(17);
            $table->integer('teryt_commune')->nullable()->default(NULL);
            $table->integer('teryt_city')->nullable()->default(NULL);
            $table->integer('teryt_street')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_addresses');
    }
};
