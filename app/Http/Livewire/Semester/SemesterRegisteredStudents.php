<?php

namespace App\Http\Livewire\Semester;

use App\Models\Semester;
use App\Models\SemesterStudent;
use App\Traits\WithTable;
use Livewire\Component;

class SemesterRegisteredStudents extends Component
{
    use WithTable;

    public $action = ['action' => 'removeSelectedStudentFromSemester'];
    protected $listeners = ['removeSelectedStudentFromSemester' => 'deleteRecord'];
    public $semesters;
    public $levels;
    public $level;
    public $has_paid;
    public $selected_semester_id;
    public $selected_record_id;

    public function mount(){
        $this->semesters = Semester::select('duration', 'id')->get();
        $this->levels = Semester::STUDENT_LEVELS;

        $this->filter = array_merge($this->filter, ['level', 'selected_semester_id', 'has_paid']);
    }

    public function deleteRecord()
    {
        SemesterStudent::findOrFail($this->selected_record_id)->delete();

        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student has been removed from semester successfully'
        ]);
       $this->reset('selected_record_id');
    }

    public function render()
    {  
        $students = SemesterStudent::with([
                        'user:id,first_name,last_name,middle_name,gender,reg_no,profile_photo_path',
                        'semester:id,duration'
                    ])
                    ->when(!empty($this->search), function ($q) {
                        return $q->whereHas('user', function ($query) {
                                    $query->where('users.first_name', 'LIKE', "%{$this->search}%")
                                    ->orWhere('users.middle_name', 'LIKE', "%{$this->search}%")
                                    ->orWhere('users.last_name', 'LIKE', "%{$this->search}%")
                                    ->orWhere('users.reg_no', 'LIKE', "%{$this->search}%");
                        });
                    })
                    ->when(!empty($this->selected_semester_id), function ($q) {
                        return $q->where('semester_id', $this->selected_semester_id);
                    })
                    ->when(!blank($this->has_paid), function ($q) {
                        return $q->where('paid', "=", $this->has_paid);
                    })
                    ->when(!empty($this->to_date), function ($q) {
                        return $q->where('created_at', '<=', $this->to_date);
                    })
                    ->when(!empty($this->from_date), function ($q) {
                        return $q->where('created_at', '>=', $this->from_date);
                    })
                    ->when(!empty($this->level), function ($q) {
                        return $q->where('level', '=', $this->level);
                    })->paginate();

        return view('livewire.semester.semester-registered-students', ['students' => $students])
                ->extends('layouts.app')
                ->section('content');
    }
}
