<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ballot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'ballotable_type', 'ballotable_id', 'semester_id'];

    public function ballotable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function scopeAwardNominees($query)
    {
        return $query->where('ballotable_type', 'award');
    }

    public function scopeComputeElectionResult($query, $ballotable_type):void
    {
        $this->getVotingResult($ballotable_type)
            ->groupBy('post')
            ->each(function($position, $name){
                $maxVotes = $position->max('votes_count');
                $position->firstWhere('votes_count', $maxVotes);

                $nominee = $position->firstWhere('votes_count', $maxVotes);
                $nominee->winner = true;
                $nominee->save();
            });
    }
    
    protected function getVotingResult($ballotable_type)
    {
        return  Ballot::select(
                    'ballots.id',
                    'p.name as post',
                    DB::raw('(select count(*) as votes from `votes` where `ballots`.`id` = `votes`.`ballot_id`) as votes_count')
                )
                ->join($ballotable_type.'s as p', 'p.id', '=', 'ballots.ballotable_id')
                ->where([
                    'ballots.semester_id' => Semester::active()->id,
                    'ballotable_type' => $ballotable_type
                ])
                ->get();
    }

    public function scopeOfficeContestants($query)
    {
        return $query->where('ballotable_type', 'office');
    }

    // public function scopeSemesterOfficeContestantsVotes($query, $semester_id = null)
    // {
    //     $semester_id = ($semester_id) ? $semester_id : Semester::active()->id;

    //     return  self::select(
    //                 DB::raw('CONCAT(contestant.first_name," ",contestant.middle_name," ",contestant.last_name) AS full_name'),
    //                 'ballots.id',
    //                 'offices.name as office',
    //                 DB::raw('(select count(*) as votes from `votes` where `ballots`.`id` = `votes`.`ballot_id`) as votes_count'),
    //             )
    //             ->officeContestants()
    //             ->join('offices', 'offices.id', '=', 'ballots.ballotable_id')
    //             ->join('users as contestant', 'contestant.id', '=', 'ballots.user_id')
    //             ->where(['ballots.semester_id' => $semester_id])
    //             ->get();
    // }

    // public function scopeSemesterOfficeWinners($query, $semester_id = null)
    // {
    //     $semester_id = ($semester_id) ? $semester_id : Semester::active()->id;

    //     return  self::select(
    //         DB::raw('CONCAT(contestant.first_name," ",contestant.middle_name," ",contestant.last_name) AS full_name'),
    //         'ballots.id',
    //         'offices.name as office'
    //     )
    //             ->officeContestants()
    //             ->join('offices', 'offices.id', '=', 'ballots.ballotable_id')
    //             ->join('users as contestant', 'contestant.id', '=', 'ballots.user_id')
    //             ->where([
    //         'ballots.semester_id' => $semester_id,
    //         'ballots.winner' => true
    //     ]);
    // }
}
