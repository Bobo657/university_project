<?php

namespace App\Http\Livewire\Semester;

use App\Models\DuesSemester;
use App\Models\Semester;
use Livewire\Component;

class SemesterLevelDues extends Component
{
    public $dues;
    public $colors = ['primary', 'success', 'info', 'warning', 'error'];

    public function mount(Semester $semester)
    {
        $this->dues = DuesSemester::withCount('students')
                        ->withSum([ 'students as debts' => fn ($query) => $query->where('paid', '0')], 'amount')
                        ->withSum([ 'students as revenue' => fn ($query) => $query->where('paid', '1')], 'amount')
                        ->where('semester_id', $semester->id)->get();

        $total_students = $this->dues->sum('students_count');

        $this->dues->map(function ($due) use ($total_students){
            $due->percent = $due->students_count > 0 ?  round(($due->students_count * 100)/$total_students)  : 0;
            $ratio = $due->students_count > 0 ?  round(($due->students_count / $total_students) * 12) : 0;

            $due->ratio = (int)$ratio;
            return $due;
        });

    }

    public function render()
    {
        return view('livewire.semester.semester-level-dues');
    }
}
