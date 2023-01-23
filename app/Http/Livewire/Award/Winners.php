<?php

namespace App\Http\Livewire\Award;

use Livewire\Component;
use App\Models\Contestant;

class Winners extends Component
{
    public $academic_session_id;
    protected $listeners = ['academic_session_changed' => 'mount'];

    public function mount($academic_session_id)
    {
        $this->academic_session_id = $academic_session_id;
    }

    public function getWinners()
    {
        return  Contestant::award()
                ->winners()
                ->with([
                'user:id,first_name,middle_name,last_name',
                'contestantable:id,name as award'
                ])
                ->where('academic_session_id', $this->academic_session_id)
                ->get();
    }

    public function render()
    {
        return view('livewire.award.winners', [
            'winners' => $this->getWinners()
        ]);
    }
}
