<?php

namespace App\Http\Livewire\Semester;

use App\Models\Semester;
use Livewire\Component;

class CreatedSemestersList extends Component
{
    public $semesters;

    public function mount()
    {

        $this->semesters = Semester::withCount(['students', 'studentsPaid', 'votes', 'officeContestants'])
                           ->withSum('students', 'amount')
                           ->withSum('studentDebtors', 'amount')
                           ->get()
                           ->map(function ($semester) {
                                $semester->income = ($semester->students_sum_amount - $semester->student_debtors_sum_amount);

                                return $semester;
                            });
    }
    
    public function render()
    {   
        return view('livewire.semester.created-semesters-list');
    }

    
}

