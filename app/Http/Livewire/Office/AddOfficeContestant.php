<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use App\Models\Semester;
use App\Models\User;
use Livewire\Component;

class AddOfficeContestant extends Component
{
    protected $listeners = ['addContestant' => 'showForm'];

    public $showModal = false;
    public $office;
    public $reg_no;

    protected $rules = [
        'reg_no' => 'required|min:6|exists:users,reg_no',
    ];

    public function showForm(Office $office)
    {
        $this->office = $office;
        $this->showModal = true;
    }

    public function addContestant()
    {
        $this->validate();
        $this->office->ballots()->create([
            'user_id' => User::firstWhere('reg_no', $this->reg_no)->id,
            'semester_id' =>  Semester::active()->id,
        ]);

        $this->showModal = false;
        $this->reset();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student has been added as successfully'
        ]);

        $this->emit('office_updated');
    }

    public function render()
    {
        return view('livewire.office.add-office-contestant');
    }
}
