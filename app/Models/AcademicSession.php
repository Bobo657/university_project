<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{
    use HasFactory;

    protected $fillable = ['duration'];

    public function scopeCurrent($query)
    {
        return $query->orderBy('id', 'desc')->first();
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function contestants(){
        return $this->hasMany(Contestant::class);
    }

    public function academic_records(){
        return $this->hasMany(AcademicRecord::class);
    }


}
