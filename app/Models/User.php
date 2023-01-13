<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'phone',
        'address',
        'password',
        'reg_no',
        'email',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }

    public function academic_records()
    {
        return $this->hasMany(AcademicRecord::class);
    }

    public function current_level()
    {
        return $this->hasOne(AcademicRecord::class)->latestOfMany();
    }

    public function unpaid_dues()
    {
        return $this->hasMany(AcademicRecord::class)->where('paid', false);
    }

    public function award_contested()
    {
        return $this->hasMany(Contestant::class)->where('contestantable_type', 'award');
    }

    public function office_contested()
    {
        return $this->hasMany(Contestant::class)->where('contestantable_type', 'office');
    }

    public function is_contesting_office()
    {
        return $this->office_contested()
                    ->where('academic_session_id', cache()->get('current_academic_sessions')->id)
                    ->first();
    }
}
