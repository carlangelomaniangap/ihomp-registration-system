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
        Schema::create('internet_requests', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('request_number');
            $table->integer('biometricID');
            $table->string('name');
            $table->enum('medical_doctor', ['Yes', 'No']);
            $table->string('employment_status');
            $table->string('division');
            $table->string('department');
            $table->string('position');
            $table->string('reason');
            $table->enum('device_type', ['AndroidSmartphone','AndroidTablet', 'WindowsLaptop', 'iPhone', 'iPad', 'MacBook']);
            $table->string('wifi_mac_address');
            $table->integer('pin_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internet_requests');
    }
};
