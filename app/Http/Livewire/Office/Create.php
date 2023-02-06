<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;

class Create extends Component
{
    protected $listeners = ['addNewOffice' => 'showForm'];
    public $showModal;
    public $name;

    protected $rules = ['name' => 'required|min:3|unique:offices,name'];

    public function showForm()
    {
        $this->resetErrorBag('name');
        $this->showModal = true;
    }

    public function save()
    {
        Office::create($this->validate());
        $this->emit('new_office_created', "{$this->name} position has been created successfully");
        $this->reset();
    }

    public function render()
    {
        return view('livewire.office.create');
    }
}
