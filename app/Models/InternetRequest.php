<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetRequest extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'role',
        'request_number',
        'biometricID',
        'first_name',
        'middle_name',
        'last_name',
        'medical_doctor',
        'employment_status',
        'division',
        'department',
        'position',
        'reason',
        'device_type',
        'wifi_mac_address',
        'pin_code',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
