<?php

namespace App\Http\Livewire\Semester;

use App\Models\Semester;
use App\Models\SemesterStudent;
use App\Traits\TableWithFilters;
use Livewire\Component;

class SemesterRegisteredStudents extends Component
{
    use TableWithFilters;

    public $actions = ['action' => 'removeSelectedStudentFromSemester'];
    protected $listeners = ['removeSelectedStudentFromSemester' => 'deleteStudentFromSemester'];
    protected $resetProperties = ['search','hasPaid', 'level', 'noOfRecords','fromDate','toDate'];

    public $semesters;
    public $levels;
    public $level;
    public $hasPaid;
    public $semesterId;

    public function mount()
    {
        $this->semesters = Semester::select('duration', 'id')->get();
        $this->levels = Semester::STUDENT_LEVELS;
        $this->semesterId = cache('active_semester')->id;

    }

    public function deleteStudentFromSemester()
    {
        SemesterStudent::findOrFail($this->recordId)->delete();

        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student has been removed from semester successfully'
        ]);
        $this->reset('recordId');
    }

    public function render()
    {
        $students = $this->getSemesterRecords();

        return view('livewire.semester.semester-registered-students', compact('students'))
                ->extends('layouts.app')
                ->section('content');
    }

    protected function getSemesterRecords(){

        $semesterQuery = SemesterStudent::with([
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
                        ->when(!empty($this->semesterId), function ($q) {
                            return $q->where('semester_id', $this->semesterId);
                        })
                        ->when(!blank($this->hasPaid), function ($q) {
                            return $q->where('paid', "=", $this->hasPaid);
                        })
                        ->when(!empty($this->toDate), function ($q) {
                            return $q->where('created_at', '<=', $this->toDate);
                        })
                        ->when(!empty($this->fromDate), function ($q) {
                            return $q->where('created_at', '>=', $this->fromDate);
                        })
                        ->when(!empty($this->level), function ($q) {
                            return $q->where('level', '=', $this->level);
                        })->paginate($this->noOfRecords);

        return $semesterQuery;
    }
}
