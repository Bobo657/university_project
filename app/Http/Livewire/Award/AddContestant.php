<?php

namespace App\Http\Livewire\Award;

use App\Models\Award;
use App\Models\User;
use Livewire\Component;

class AddContestant extends Component
{
    protected $listeners = ['showNewContestantForm' => 'showForm'];

    public $showModal = false;
    public $awards = [];
    public $award = "";
    public $reg_no;

    protected $rules = [
        'reg_no' => 'required|min:6|exists:users,reg_no',
        'award' => 'required|integer|exists:awards,id',
    ];

    public function showForm(){
        $this->awards = Award::all();
        $this->showModal = true;
    }

    public function save(){
        $this->validate();
        $student = User::where('reg_no', $this->reg_no)->first();

        $student->award_contested()->create([
                    'academic_session_id' =>  cache()->get('current_academic_sessions')->id,
                    'contestantable_type' => 'award',
                    'contestantable_id' => $this->award,
                ]);

        $this->showModal = true;
        $this->reset();
        $this->emit('showNotification', "{$student->fullname} has been added as a contestant successfully");
    }

    public function render()
    {
        return view('livewire.award.add-contestant');
    }
}
