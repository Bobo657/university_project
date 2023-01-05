<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contestantable_type', 'contestantable_id', 'academic_session_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOffice($query)
    {
        return $query->where('contestantable_type', 'office');
    }

    public function scopeAward($query)
    {
        return $query->where('contestantable_type', 'award');
    }

    public function scopeWinners($query)
    {
        return $query->where('is_winner', 1);
    }

    public function academicsession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function contestantable()
    {
        return $this->morphTo();
    }

}
