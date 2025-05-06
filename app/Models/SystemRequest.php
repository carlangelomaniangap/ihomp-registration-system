<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemRequest extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'role',
        'biometricID',
        'username',
        'password',
        'medical_doctor',
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'sex',
        'civil_status',
        'email',
        'mobile_number',
        'telephone_number',
        'division',
        'department',
        'position',
        'prc_license_number',
        'expiration_date',
        'employment_status',
        'systems_to_be_enrolled',
        'emr_sdn_user_profile',
        'pin_code',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
