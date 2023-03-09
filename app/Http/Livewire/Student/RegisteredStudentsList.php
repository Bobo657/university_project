<?php

namespace App\Http\Livewire\Student;

use App\Models\User;
use Livewire\Component;
use App\Traits\WithTable;
use Illuminate\Support\Facades\DB;

class RegisteredStudentsList extends Component
{
    use WithTable;

    protected $listeners = ['removeSelectedStudent' => 'deleteRecord'];
    public $action = ['action' => 'removeSelectedStudent'];
    public $stats;
    public $email_verification;
    public $gender;
    
    
    public function mount()
    {
        $this->stats = User::select(
            DB::raw("
                count(*) as total_students,
                SUM(gender = 'male') AS male_students, 
                COUNT(IFNULL(email_verified_at, NULL)) AS verified_students
            "))->first();

           $this->mergeFilters();
    }

    protected function mergeFilters(): void
    {
        $this->filter = array_merge($this->filter, ['email_verification', 'gender']);
    }

    public function deleteRecord()
    {
        User::findOrFail($this->selected_record_id)->delete();

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
                    ->when(!empty($this->to_date), function ($q) {
                                    return $q->where('created_at', '<=', $this->to_date);
                    })
                    ->when(!blank($this->email_verification), function ($q) {
                            $operator = $this->email_verification > 0 ? '!=' : '=';
                            return $q->where('email_verified_at', $operator, null);
                    })
                    ->when(!empty($this->gender), function ($q) {
                            return $q->where('gender', '=', $this->gender);
                    })
                    ->when(!empty($this->from_date), function ($q) {
                                    return $q->where('created_at', '>=', $this->from_date);
                    })
                    ->when(!blank($this->active), function ($q) {
                                    return $q->where('active', $this->active);
                    })
                    ->paginate($this->no_of_records);

        return view('livewire.student.registered-students-list', ['students' => $students])
                ->extends('layouts.app')
                ->section('content');
    }
}
