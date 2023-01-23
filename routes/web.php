<?php

use App\Http\Livewire\Award\Dashboard;
use App\Http\Livewire\Office\Dashboard as OfficeDashboard;
use App\Http\Livewire\Students\{RegisteredStudents,AcademicRecords};
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Votes\{Offices,Awards};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('students/registered', RegisteredStudents::class)->name('registered.students');
Route::get('students/academic/records', AcademicRecords::class)->name('academic.records');
Route::get('students/awards/dashboard', Dashboard::class)->name('awards.dashboard');
Route::get('students/offices/dashboard', OfficeDashboard::class)->name('office.dashboard');
Route::get('votes/offices', Offices::class)->name('votes.offices');
Route::get('votes/awards', Awards::class)->name('votes.awards');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
