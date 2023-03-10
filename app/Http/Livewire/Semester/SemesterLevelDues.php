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
       
        $this->dues =  $this->getDuesStats($semester); 
        
        $total_students = $this->dues->sum('semester_students_count');

        $this->dues->each(function ($due) use ($total_students){
            $students_count = $due->semester_students_count;
            
            $due->percent = $students_count > 0 ?  round(($students_count * 100)/$total_students)  : 0;
            $ratio = $students_count > 0 ?  round(($students_count / $total_students) * 12) : 0;

            $due->ratio = (int)$ratio;
        });

        $this->dues;
    }

    public function render()
    {
        return view('livewire.semester.semester-level-dues');
    }

    protected function getDuesStats($semester){

        $duesStat = DuesSemester::withCount('semesterStudents')
                    ->withSum([ 
                        'semesterStudents as sumDebts' => function($query){
                            $query->where('paid', '0');
                    }], 'amount')
                    ->withSum([ 
                        'semesterStudents as sumIncome' => function($query){
                            $query->where('paid', '1');
                    }], 'amount')
                    ->where('semester_id', $semester->id)
                    ->get();

        return $duesStat;
    }
}
