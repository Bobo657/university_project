<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class CreateNewOfficeForm extends Component
{
    public $name;

    public function createOffice()
    {
        $this->resetValidation();

        Validator::make(['name' => $this->name], [
            'name' => 'required|unique:offices,name'
        ], [
            'name.required' => 'The office name is required.',
            'name.unique' => 'The office name already exists.'
        ])->validate();

        Office::create([
            'name' => $this->name
        ]);

        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'The office has been created successfully.'
        ]);

        $this->emit('office_updated');
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.office.create-new-office-form');
    }
}
