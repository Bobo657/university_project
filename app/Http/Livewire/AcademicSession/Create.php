<?php

namespace App\Http\Livewire\AcademicSession;

use App\Models\AcademicSession;
use Livewire\Component;

class Create extends Component
{
    protected $listeners = ['addNewAcademicSession' => 'showForm'];
    public $showModal;
    public $duration;
        
    protected $rules = ['duration' => 'required|min:6|unique:academic_sessions,duration'];

    public function showForm(){
        //$this->resetErrorBag('duration');
        $this->showModal = true;
    }

    public function save(){
       AcademicSession::create($this->validate());
       $this->reset();
       $this->emit('academic_session_created', "{$this->duration} Academic Session has been created successfully");
    }

    public function render()
    {
        return view('livewire.academic-session.create');
    }
}
