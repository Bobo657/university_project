<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.students.profile')
        ->extends('layouts.app')
        ->section('content');
    }
}
