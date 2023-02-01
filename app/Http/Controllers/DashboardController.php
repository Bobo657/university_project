<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = User::selectRaw("
                    COUNT(*) as total_students,
                    SUM(users.gender = 'female') AS female_students,
                    SUM(users.is_active = 0) AS suspended_students,
                    SUM(users.graduated = 1) AS graduated_students,
                    SUM(users.email_verified_at = NULL) AS verified_students")
                    ->get()->first();

        // AcademicRecord::selectRaw("academic_sessions.duration,
        //     SUM(users.gender = 'female') AS female_students,
        //     SUM(users.gender = 'male') AS male_students")
        //     ->join('users', 'users.id', '=', 'academic_records.user_id')
        //     ->join('academic_sessions', 'academic_sessions.id', '=', 'academic_records.academic_session_id')
        //     ->groupBy('academic_sessions.duration')
        //     ->get()->pluck('duration')->dd();
        

        return view('welcome', ['stats' => $stats]);
    }
}
