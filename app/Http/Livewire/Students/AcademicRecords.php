<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\AcademicRecord;
use App\Models\AcademicSession;
use Livewire\WithPagination;

class AcademicRecords extends Component
{
    use WithPagination;

    public $academic_sessions;
    public $level;
    public $selected_academic_session_id;
    public $showDeleteNotification = false;
    public $selected_record;
    public $notification_message;
    public $no_of_records = 10;
    public $to_date;
    public $from_date;
    public $search;
    public $has_paid;

    public function mount()
    {
        $this->academic_sessions = AcademicSession::all();
    }

    public function resetParameters(){
        $this->reset(['search', 'from_date', 'to_date', 'level', 'selected_academic_session_id']);
    }

    public function clearMessage(){
        $this->reset('notification_message');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingNoOfRecords()
    {
        $this->resetPage();
    }

    public function showDeleteNotification(AcademicRecord $record)
    { 
        $this->showDeleteNotification = true;
        $this->selected_record = $record;
    }

    public function deleteStudent()
    {
        $this->selected_record->delete();
        $this->showDeleteNotification  = false;
        $this->notification_message = "Student Academic record was deleted successfully";
        $this->reset('selected_record','showDeleteNotification');
    }

    public function render()
    {
        $academic_session = ($this->selected_academic_session_id) ? $this->academic_sessions->find($this->selected_academic_session_id) : $this->academic_sessions->last();

        $students = AcademicRecord::with([
                        'user:id,first_name,last_name,middle_name,gender,reg_no',
                        'academicSession:id,duration'
                    ])
                    ->where('academic_session_id', $academic_session->id)
                    ->when(!empty($this->search), function ($q) {
                        return $q->whereHas('user', function ($query) {
                            $query->where('users.first_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.middle_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.last_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('users.reg_no', 'LIKE', "%{$this->search}%");
                        });
                    })
                    ->when(!empty($this->has_paid), function ($q) {
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
                    })
                    ->paginate($this->no_of_records);

        return view('livewire.students.academic-records', [
            'academic_session' => $academic_session,
            'students' => $students
        ])
        ->extends('layouts.app')
        ->section('content');
    }
}
