<?php

namespace App\Http\Livewire\Student;

use App\Models\User;
use Livewire\Component;
use App\Traits\TableWithFilters;
use Illuminate\Support\Facades\DB;

class RegisteredStudentsList extends Component
{
    use TableWithFilters;

    protected $listeners = ['removeSelectedStudent' => 'deleteStudent'];
    public $actions = ['action' => 'removeSelectedStudent'];
    protected $resetProperties = ['search', 'gender', 'noOfRecords', 'emailVerification', 'toDate', 'fromDate',  'active'];

    public $stats;
    public $emailVerification;
    public $gender;
    public $active;

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

    public function deleteStudent()
    {
        User::findOrFail($this->recordId)->delete();

        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student has been delete successfully'
        ]);
        $this->reset('selected_record_id');
    }

    public function toggleStatus(User $user)
    {
        $user->changeStatus();
    }

    public function render()
    {
        $students = User::with(['last_level'])
                    ->withSum('unpaidDues as total_debt', 'amount')
                    ->when(!empty($this->search), function ($q) {
                        return $q->where('first_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('middle_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('last_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('email', 'LIKE', "%{$this->search}%")
                                ->orWhere('phone', 'LIKE', "%{$this->search}%");
                    })
                    ->when(!empty($this->toDate), function ($q) {
                        return $q->where('created_at', '<=', $this->toDate);
                    })
                    ->when(!blank($this->emailVerification), function ($q) {
                        $operator = $this->emailVerification > 0 ? '!=' : '=';
                        return $q->where('email_verified_at', $operator, null);
                    })
                    ->when(!empty($this->gender), function ($q) {
                        return $q->where('gender', '=', $this->gender);
                    })
                    ->when(!empty($this->fromDate), function ($q) {
                        return $q->where('created_at', '>=', $this->fromDate);
                    })
                    ->when(!blank($this->active), function ($q) {
                        return $q->where('active', $this->active);
                    })
                    ->paginate($this->noOfRecords);

        return view('livewire.student.registered-students-list', ['students' => $students])
                ->extends('layouts.app')
                ->section('content');
    }
}
