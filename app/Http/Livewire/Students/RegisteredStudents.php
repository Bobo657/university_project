<?php

namespace App\Http\Livewire\Students;

use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;
use DB;

class RegisteredStudents extends Component
{
    use WithPagination;

    public $search;
    public $no_of_records = 10;
    public $from_date;
    public $to_date;
    public $showDeleteNotification = false;
    public $selected_student;
    public $notification_message;
    public $stats;
    public $gender;
    public $email_verification;
    public $is_active;

    public function mount()
    {
        $this->stats = User::select(
            DB::raw("
                count(*) as total_students,
                SUM(gender = 'male') AS male_students, 
                COUNT(IFNULL(email_verified_at, NULL)) AS verified_students
            ")
        )->first();
    }

    public function resetParameters(){
        $this->reset(['search', 'from_date', 'to_date', 'is_active', 'email_verification', 'gender']);
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

    public function toggleStatus(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
    }

    public function showDeleteNotification(User $student)
    {
        $this->showDeleteNotification = true;
        $this->selected_student = $student;
    }

    public function deleteStudent()
    {
        $this->selected_student->delete();
        $this->showDeleteNotification  = false;
        $this->notification_message = "Student record was deleted successfully";
        $this->reset('selected_student');
    }

    public function render()
    {
        $students = User::with(['current_level'])
                    ->withSum('unpaid_dues as unpaid', 'dues')
                    ->when(!empty($this->search), function ($q) {
                        return $q->where('first_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('middle_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('last_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('email', 'LIKE', "%{$this->search}%")
                                ->orWhere('phone', 'LIKE', "%{$this->search}%");
                    })
                    ->when(!empty($this->to_date), function ($q) {
                        return $q->where('created_at', '<=', $this->to_date);
                    })
                    ->when(!empty($this->email_verification), function ($q) {
                        return $q->where('email_verified_at', '=', $this->email_verification);
                    })
                    ->when(!empty($this->gender), function ($q) {
                        return $q->where('gender', '=', $this->gender);
                    })
                    ->when(!empty($this->from_date), function ($q) {
                        return $q->where('created_at', '>=', $this->from_date);
                    })
                    ->when(!empty($this->is_active), function ($q) {
                        return $q->where('is_active', $this->is_active);
                    })
                    ->paginate($this->no_of_records);

        return view('livewire.students.registered-students', ['students' => $students])
        ->extends('layouts.app')
        ->section('content');
    }
}
