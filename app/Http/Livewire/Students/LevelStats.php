<?php

namespace App\Http\Livewire\Students;

use App\Models\AcademicRecord;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LevelStats extends Component
{
    public $levels;

    public function render()
    {
        return view('livewire.students.level-stats');
    }

    public function mount()
    {
        AcademicRecord::Distinct()->get('level');

        $this->levels = AcademicRecord::selectRaw("academic_records.level,
                        COUNT(*) as total_students,
                        SUM(users.gender = 'female') AS female_students,
                        SUM(users.gender = 'male') AS male_students")
                        ->join('users', 'users.id', '=', 'academic_records.user_id')
                        ->groupBy('academic_records.level')
                        ->get();
    }
}
