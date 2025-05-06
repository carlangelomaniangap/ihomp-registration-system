<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role',
        'biometricID',
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'sex',
        'civil_status',
        'email',
        'mobile_number',
        'telephone_number',
        'medical_doctor',
        'employment_status',
        'division',
        'department',
        'position',
        'prc_license_number',
        'expiration_date',
        'emr_sdn_user_profile',
    ];

    public function internetRequests() {
        return $this->hasMany(InternetRequest::class);
    }

    public function systemRequests() {
        return $this->hasMany(SystemRequest::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
