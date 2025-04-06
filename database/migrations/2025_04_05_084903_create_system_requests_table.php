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
        Schema::create('system_requests', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->integer('biometricID');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('medical_doctor', ['Yes', 'No']);
            $table->string('name');
            $table->date('birthday');
            $table->enum('sex', ['Male', 'Female']);
            $table->enum('civil_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->string('email');
            $table->string('mobile_number');
            $table->string('telephone_number');
            $table->string('division');
            $table->string('department');
            $table->string('position');
            $table->string('prc_license_number'); // is the data here is from user details?
            $table->date('expiration_date'); // is the data here is from user details?
            $table->string('employment_status');
            $table->string('systems_to_be_enrolled');
            $table->string('emr_sdn_user_profile'); // is the data here is from user details?
            $table->string('pin_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_requests');
    }
};
