<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;

class CreateNewOfficeForm extends Component
{
    public $name;

    public function createOffice()
    {
        Office::create($this->validate(
            ['name' => 'required|unique:offices,name'],
            ['name.unique' => 'Office already exist in the data base'],
            ['name' => 'Office']
        ));

        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Office has been created successfully'
        ]);

        $this->emit('office_updated');
    }

    public function render()
    {
        return view('livewire.office.create-new-office-form');
    }
}
