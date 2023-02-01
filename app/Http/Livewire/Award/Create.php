<?php

namespace App\Http\Livewire\Award;

use App\Models\Award;
use Livewire\Component;

class Create extends Component
{
    protected $listeners = ['addNewAward' => 'showForm'];
    public $showModal;
    public $name;
        
    protected $rules = ['name' => 'required|min:6|unique:awards,name'];

    public function showForm(){
        $this->resetErrorBag('name');
        $this->showModal = true;
    }

    public function save(){
       Award::create($this->validate());
       $this->emit('new_award_created', "{$this->name} position has been created successfully");
       $this->reset();
    }

    public function render()
    {
        return view('livewire.award.create');
    }
}
