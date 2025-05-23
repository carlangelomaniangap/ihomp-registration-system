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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->unsignedInteger('biometricID');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->enum('sex', ['Male', 'Female']);
            $table->enum('civil_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->string('email');
            $table->string('mobile_number');
            $table->string('telephone_number');
            $table->enum('medical_doctor', ['Yes', 'No']);
            $table->enum('employment_status', ['Regular/Permanent','Job Order','Temporary/COS','Medical Intern']);
            $table->enum('division', ['ANCILLARY', 'FINANCE', 'HOPS', 'MCC', 'MEDICAL', 'NURSING']);
            $table->string('department');
            $table->string('position');
            $table->string('prc_license_number');
            $table->date('expiration_date');
            $table->enum('emr_sdn_user_profile', ['User', 'Pharmacy', 'Social Service', 'Cashier', 'Nurse', 'Doctor']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
