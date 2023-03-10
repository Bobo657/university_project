<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Semester\SemesterDetails;
use App\Http\Livewire\Semester\SemesterRegisteredStudents;
use App\Http\Livewire\Student\RegisteredStudentsList;
use App\Http\Livewire\Student\StudentProfile;
use App\Http\Livewire\Vote\VotersList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::loginUsingId(1);

Route::get('/', [DashboardController::class, 'dashboard']);

Route::view('/dashboard/offices', 'livewire.office.office-details')->name('offices.dashboard');
Route::view('/awards/dashboard', 'livewire.award.awards-details')->name('awards.dashboard');
Route::get('/semesters/semester/details/{semester}',  SemesterDetails::class)->name('semester.details');
Route::get('/registered/students', RegisteredStudentsList::class)->name('registered.students');
Route::get('/semseters/registered/students', SemesterRegisteredStudents::class)->name('semester.registered students');
Route::get('/voters/list',  VotersList::class)->name('voters.list');
Route::get('/student/profile/{student}', StudentProfile::class)->name('student.profile');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
