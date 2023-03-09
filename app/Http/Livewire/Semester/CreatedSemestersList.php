<?php

namespace App\Http\Livewire\Semester;

use App\Models\Semester;
use Livewire\Component;

class CreatedSemestersList extends Component
{
    public $semesters;
    
    public function render()
    {   
        $this->semesters = Semester::withCount(['students', 'studentsPaid', 'votes', 'officeContestants'])
                           ->withSum('students', 'amount')
                           ->withSum('studentDebtors', 'amount')
                           ->get();

        return view('livewire.semester.created-semesters-list');
    }

    
}

