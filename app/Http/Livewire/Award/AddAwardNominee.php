<?php

namespace App\Http\Livewire\Award;

use App\Models\Award;
use App\Models\Semester;
use App\Models\User;
use Livewire\Component;

class AddAwardNominee extends Component
{
    protected $listeners = ['addNominee' => 'showForm'];

    public $showModal = false;
    public $award;
    public $reg_no;

    protected $rules = [
        'reg_no' => 'required|min:6|exists:users,reg_no',
    ];

    public function showForm(Award $award)
    {
        $this->award = $award;
        $this->showModal = true;
    }

    public function addNominee()
    {
        $this->validate();
        $this->award->ballots()->create([
            'user_id' => User::firstWhere('reg_no', $this->reg_no)->id,
            'semester_id' =>  Semester::active()->id,
        ]);

        $this->showModal = false;
        $this->reset();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student has been added as successfully'
        ]);
    }

    public function render()
    {
        return view('livewire.award.add-award-nominee');
    }
}
