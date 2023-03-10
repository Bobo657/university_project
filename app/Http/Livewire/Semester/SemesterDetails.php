<?php

namespace App\Http\Livewire\Semester;

use App\Models\Semester;
use App\Models\SemesterStudent;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SemesterDetails extends Component
{
    use WithPagination;
    protected $listeners = ['removeSelectedRecord' => 'deleteRecord'];
    public $semester;
    public $stats;
    public $has_paid;
    public $no_of_records;
    public $levels;
    public $level;
    public $record;
    public $redirect;
    public $noOfGraduated = 0;
    public $noOfEnrolled = 0;

    public function mount(Semester $semester)
    {
        $this->levels = Semester::STUDENT_LEVELS;

        $this->stats =  SemesterStudent::selectRaw(
                            "COUNT(*) as total_students,
                            SUM(users.gender = 'female') AS female_students,
                            SUM(users.gender = 'male') AS male_students,
                            SUM(paid = 0) AS debtors"
                        )
                        ->join('users', 'users.id', '=', 'semester_students.user_id')
                        ->where('semester_students.semester_id','=', $semester->id)
                        ->get()
                        ->first();
    }


    public function confirmDeleteRecord(SemesterStudent $semesterStudent) : void
    {
        $this->record = $semesterStudent;
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedRecord']);
    }

    public function confirmDeleteSemeter(Semester $semester) : void
    {
        $this->record = $semester;
        $this->redirect = true;
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedRecord']);
    }

    public function deleteRecord()
    {
        $this->record->delete();
        session()->flash('message', 'Semester was deleted successfully');
        if($this->redirect){
            redirect('/');
        }

        $this->reset('record');
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student has been removed from semester successfully'
        ]);
        
    }

    public function setSemesterToCompleted(Semester $semester)
    {
        $semester->markAsCompleted();
    }

    public function startStudentsEnrollment()
    {
        
        $students = User::haveNotGraduated()->with('last_level')->get();
        $students->each(function ($student){
            if($student->canBeMarkedAsGraduated()){
                $student->markAsGraduated();
               return $this->noOfGraduated += 1;
            }

            try {
               $student->addToActiveSemesterList();
               $this->noOfEnrolled += 1;
            } catch (\Exception $e) {
                //dd($e->getMessage());
            } 
        });

        session()->flash('enrollement', 'Enrollenment has been completed');
    }

    public function render()
    {
        $students = SemesterStudent::with([
                        'user:id,first_name,last_name,middle_name,reg_no,gender,profile_photo_path'
                    ])
                    ->when(!empty($this->search), function ($q) {
                        return $q->whereHas('user', function ($query) {
                            $query->where('users.first_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.middle_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.last_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.reg_no', 'LIKE', "%{$this->search}%");
                        });
                    })
                    ->where('semester_id', $this->semester->id)
                    ->when(!blank($this->has_paid), function ($q) {
                        return $q->where('paid', "=", $this->has_paid);
                    })
                    ->when(!empty($this->level), function ($q) {
                        return $q->where('level', '=', $this->level);
                    })->paginate();

        return view('livewire.semester.semester-details', [
                    'students' => $students
                ])
                ->extends('layouts.app')
                ->section('content');
    }
}
