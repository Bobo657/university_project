<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function ballots()
    {
        return $this->morphMany(Ballot::class, 'ballotable');
    }

    public function lastestWinner()
    {
        return $this->morphOne(Ballot::class, 'ballotable')->where('winner', 1)->latestOfMany('winner');
    }

    public function votes()
    {
        return  $this->hasManyThrough(
            Vote::class,
            Ballot::class,
            'ballotable_id',
            'ballot_id',
            'id',
            'id'
        )->where('ballots.ballotable_type', 'office');
    }
}
