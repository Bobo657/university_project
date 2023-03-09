<?php

namespace App\Http\Livewire\Award;

use App\Models\Award;
use Livewire\Component;

class CreateNewAwardForm extends Component
{
    public $name;

    public function createAward()
    {
        Award::create($this->validate(
            ['name' => 'required|unique:awards,name'],
            ['name.unique' => 'Award already exist in the data base'],
            ['name' => 'Award']
        ));
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Award has been created successfully'
        ]);

        $this->emit('award_updated');
    }

    public function render()
    {
        return view('livewire.award.create-new-award-form');
    }
}
