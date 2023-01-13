<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;
use App\Models\Office;
use App\Models\User;

class AddContestant extends Component
{
    protected $listeners = ['showNewContestantForm' => 'showForm'];

    public $showModal = false;
    public $offices = [];
    public $office = "";
    public $reg_no;
    public $notification_message;

    protected $rules = [
        'reg_no' => 'required|min:6|exists:users,reg_no',
        'office' => 'required|integer|exists:offices,id',
    ];

    public function clearMessage(){
        $this->reset('notification_message');
    }

    public function showForm(){
        $this->offices = Office::all();
        $this->showModal = true;
    }

    public function save(){
        $this->validate();
        $student = User::where('reg_no', $this->reg_no)->first();

        if(!$student->is_contesting_office()){
            $student->office_contested()->create([
                'academic_session_id' =>  cache()->get('current_academic_sessions')->id,
                'contestantable_type' => 'office',
                'contestantable_id' => $this->office,
            ]);

            $this->showModal = true;
            $this->reset();
            $this->emit('showNotification', "{$student->fullname} has been added as a contestant successfully");
        }
        else
        {
            $this->notification_message = "{$student->fullname} is already contesting for an office";
        }
    }

    
    public function render()
    {
        return view('livewire.office.add-contestant');
    }
}
