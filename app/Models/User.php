<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->middle_name. ' '  . $this->last_name;
    }

    public function getProfilePhotoPathAttribute()
    {
        // if ($this->profile_photo_path) {
        //     return  cloudinary()->getImage($this->cloud_public_id);
        // }
    
        return "/images/".strtolower($this->gender).'.png';
    }

    public function getPathAttribute()
    {
        return route('student.profile', ['student' => $this->id]);
    }

    public function toggleStatus(){
        $this->active = !$this->active;
        $this->save();
    }

    public function markAsGraduated(){
        $this->graduated = true;
        $this->save();
    }

    public function toggleGraduation()
    {
        $this->graduated = !$this->graduated;
        $this->save();
    }

    public function ballots()
    {
        return $this->hasMany(Ballot::class);
    }

    public function last_level()
    {
        return $this->hasOne(SemesterStudent::class)->latestOfMany();
    }

    public function levels()
    {
        return $this->hasMany(SemesterStudent::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function unpaidDues()
    {
        return $this->levels()->where('paid', false);
    }

    public function scopeHaveNotGraduated($query)
    {
        return $query->where('graduated', false);
    }

    public function addToActiveSemesterList() : void
    {
        $level = $this->last_level ? ((int)$this->last_level->level + 100) : 100;
        $semester_id = Semester::active()->id;
        $amount = DuesSemester::getSemesterLevelAmount($semester_id, $level);

        SemesterStudent::create([
            'user_id' => $this->id,
            'level' => $level,
            'amount' => $amount,
            'semester_id' => $semester_id
        ]);
    }

    public function canAddToActiveSemesterList() : bool
    {
        return optional($this->last_level)->level == Semester::MAX_LEVEL;
    }


}
