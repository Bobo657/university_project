<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class DuesSemester extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['semester_id', 'level', 'amount'];

    protected function amount(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            set: fn (string $value) =>  str_replace(",","",$value),
        );
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function students()
    {
        return $this->hasMany(SemesterStudent::class, 'level', 'level')->where('semester_id', $this->semester_id);
    }

    public function scopeGetSemesterLevelAmount($query, $semester_id, $level) : int
    {
        $dues =  $query->firstWhere([
                    'level' => $level, 
                    'semester_id' => $semester_id
                   ]);

        return ($dues) ? $dues->amount : false;
    }
}
