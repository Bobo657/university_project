<?php

namespace App\Models;

use App\Observers\SemesterObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Semester extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['duration'];

    const STUDENT_LEVELS = [100, 200, 300, 400, 500];
    const MAX_LEVEL = 500;

    static function active()
    {
        return self::firstWhere('current', 1);
    }

    public function getColorAttribute()
    {
        return $this->current ?  'success' : 'error';
    }

    public function getStatusAttribute()
    {
        return $this->current ?  'Active' : 'Completed';
    }

    public function markAsCompleted(): void
    {
        $this->current = 0;
        $this->save();
    }

    public function dues()
    {
        return $this->hasMany(DuesSemester::class);
    }

    public function students()
    {
        return $this->hasMany(SemesterStudent::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function studentDebtors()
    {
        return $this->students()->where('paid', false);
    }

    public function studentsPaid()
    {
        return $this->students()->where('paid', true);
    }

    public function awardNominees()
    {
        return $this->hasMany(Ballot::class)->where('ballotable_type', 'award');
    }

    public function awardWinners()
    {
        return $this->awardNominees()->where('winner', true);
    }

    // public function scopeWinnersBySemesterId($query, $semester_id, $ballotable_type)
    // {
    //     return  self::select(
    //                     DB::raw('CONCAT(nominee.first_name," ",nominee.middle_name," ",nominee.last_name) AS full_name'),
    //                     'ballots.id',
    //                     'nominee.profile_photo_path',
    //                     'semesters.duration',
    //                     'post.name as post'
    //                 )
    //                 ->join('ballots', 'ballots.semester_id', '=', 'semesters.id')
    //                 ->join($ballotable_type.'s as post', 'post.id', '=', 'ballots.ballotable_id')
    //                 ->join('users as nominee', 'nominee.id', '=', 'ballots.user_id')
    //                 ->where([
    //                     'ballots.semester_id' => $semester_id,
    //                     'ballots.ballotable_type' => $ballotable_type,
    //                     'ballots.winner' => true
    //                 ]
    //             );
    // }

    public function officeContestants()
    {
        return $this->hasMany(Ballot::class)->where('ballotable_type', 'office');
    }

    public function officeWinners()
    {
        return $this->officeContestants()->where('winner', true);
    }

    public static function boot()
    {
        parent::boot();

        self::observe(SemesterObserver::class);
    }



}
