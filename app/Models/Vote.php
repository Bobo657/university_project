<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vote extends Model
{
    use HasFactory;

    public function ballot(){
        return $this->belongsTo(Ballot::class);
    }

    public function voter(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function semester(){
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function voteOwner()
    {
        return $this->hasOneThrough(
            User::class,
            Ballot::class,
            'id', 
            'id', 
            'ballot_id', 
            'user_id' 
        );
    }

    public function scopeVotesBySemesterId($query, $semester_id, $ballotable_type)
    {
        return  $query->where(['semester_id' => $semester_id])
                ->whereHas('ballot', function($q) use ($ballotable_type){
                    $q->where('ballotable_type', $ballotable_type);
                });
    }
}
