<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = ['name'];
    
    use HasFactory;

    public function contestants()
    {
        return $this->morphMany(Contestant::class, 'contestantable');
    }

    public function votes()
    {
        return  $this->hasManyThrough(
            Vote::class,
            Contestant::class,
            'contestantable_id',
            'contestant_id',
            'id',
            'id'
        )->where('contestants.contestantable_type', 'award');
    }
}
