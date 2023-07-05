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
        Schema::table('alerts', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('device_addresses', function (Blueprint $table) {
            $table->foreign('device_id')->references('id')->on('devices')->cascadeOnDelete();
        });

        Schema::table('alert_areas', function (Blueprint $table) {
            $table->foreign('alert_id')->references('id')->on('alerts')->cascadeOnDelete();
        });

        Schema::table('alert_device_notifications', function (Blueprint $table) {
            $table->foreign('alert_id')->references('id')->on('alerts')->cascadeOnDelete();
            $table->foreign('device_id')->references('id')->on('devices')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
