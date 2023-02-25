<?php

namespace App\Http\Livewire\Student;

use App\Models\User;
use Livewire\Component;
use App\Traits\WithSorting;

class RegisteredStudentsList extends Component
{
    use WithSorting;

    public function render()
    {
        $students = User::all();
        //with(['current_level'])
        //->withSum('unpaid_dues as unpaid', 'dues')
        // ->when(!empty($this->search), function ($q) {
                    //     return $q->where('first_name', 'LIKE', "%{$this->search}%")
                    //             ->orWhere('middle_name', 'LIKE', "%{$this->search}%")
                    //             ->orWhere('last_name', 'LIKE', "%{$this->search}%")
                    //             ->orWhere('email', 'LIKE', "%{$this->search}%")
                    //             ->orWhere('phone', 'LIKE', "%{$this->search}%");
        // })
        // ->when(!empty($this->to_date), function ($q) {
                    //     return $q->where('created_at', '<=', $this->to_date);
        // })
        // ->when(!blank($this->email_verification), function ($q) {
                    //     $operator = $this->email_verification > 0 ? '!=' : '=';
                    //     //dd($operator);

                    //     return $q->where('email_verified_at', $operator, null);
        // })
        // ->when(!empty($this->gender), function ($q) {
                    //     return $q->where('gender', '=', $this->gender);
        // })
        // ->when(!empty($this->from_date), function ($q) {
                    //     return $q->where('created_at', '>=', $this->from_date);
        // })
        // ->when(!blank($this->is_active), function ($q) {
                    //     return $q->where('is_active', $this->is_active);
        // })
        // ->paginate($this->no_of_records);

        return view('livewire.student.registered-students-list', ['students' => $students])
                ->extends('layouts.app')
                ->section('content');
    }
}
