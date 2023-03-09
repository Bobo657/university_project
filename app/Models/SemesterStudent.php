<?php

namespace App\Models;

use App\Observers\SemesterStudentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SemesterStudent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['amount', 'level', 'semester_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        SemesterStudent::observe(SemesterStudentObserver::class);
    }

}
