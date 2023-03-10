<?php

namespace App\Http\Controllers;

use App\Models\SemesterStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $colors = ['primary', 'success', 'info', 'warning', 'error'];

    public function dashboard()
    {
        $stats =  User::selectRaw(
                        "COUNT(*) as total_students,
                        SUM(gender = 'female') AS female_students,
                        SUM(email_verified_at = '') AS unverified_students,
                        SUM(graduated = 1) AS graduated_students,
                        SUM(active = 0) AS inactive_students"
                  )
                  ->first();

        $stats->male_students =  $stats->total_students - $stats->female_students;

        return view('welcome', [
            'stats' => $stats, 
            'levelsStats' => $this->getSemesterStudents(),
            'colors' => $this->colors, 
        ]);
    }

    private function getSemesterStudents()
    {
        $levelsStats = SemesterStudent::select(DB::raw('level, count(*) as count'))
                        ->groupBy('level')
                        ->get();

                        $total_students = $levelsStats->sum('count');              

                        $levelsStats->each(function ($level) use ($total_students){
                            $count = $level->count;
                            
                            $level->percent = $count > 0 ?  round(($count * 100)/$total_students)  : 0;
                            $ratio = $count > 0 ?  round(($count / $total_students) * 12) : 0;

                            $level->ratio = (int)$ratio;
                        });

        return $levelsStats;
    }
}
