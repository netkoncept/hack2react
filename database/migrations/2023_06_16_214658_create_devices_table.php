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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('os')->nullable()->default(NULL);
            $table->string('os_version')->nullable()->default(NULL);
            $table->string('model')->nullable()->default(NULL);
            $table->boolean('can_force_localization')->default(0);
            $table->integer('citizen')->default(0);
            $table->integer('tourist')->default(0);
            $table->string('push_id')->default('');
            $table->dateTime('last_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
