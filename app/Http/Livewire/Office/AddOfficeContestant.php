<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use App\Models\User;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

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
        
        $validatedData = $this->validate();

        try{
            $user = User::firstWhere('reg_no', $validatedData['reg_no']);
            $this->office->ballots()->create([
                'user_id' => $user->id,
                'semester_id' =>  cache('active_semester')->id
            ]);

            $this->reset(['reg_no']);
            $this->showModal = false;
            $this->dispatchBrowserEvent('display-notification', [
                'message' => 'Student has been added as successfully'
            ]);

            $this->emit('office_updated');
        }
        catch (\Exception $e) {
            dd($e->getMessage());
           // $this->addError('key', 'message')
        } 
    }

    public function render()
    {
        return view('livewire.office.add-office-contestant');
    }
}
