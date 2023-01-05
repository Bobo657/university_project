<?php

namespace App\Http\Livewire\Students;

use App\Models\AcademicRecord;
use Livewire\Component;
use App\Models\User;

class StudentAcademicRecords extends Component
{
    protected $listeners = ['showStudentRecords' => 'showRecords'];

    public $showModal = false;
    public $student_name = '';
    public $academic_records = [];

    public function showRecords(User $user)
    {
        $this->student_name =  $user->full_name;
        $this->academic_records = AcademicRecord::with('academicSession:id,duration')
                                  ->where('user_id', $user->id)
                                  ->get();
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.students.student-academic-records');
    }
}
