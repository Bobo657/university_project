<?php

namespace App\Http\Livewire\Award;

use App\Models\Award;
use Livewire\Component;

class Table extends Component
{ 
    protected $listeners = ['new_award_created' => 'notify'];

    public $awards;
    public $notification_message;
     
    public function notify($message)
    {
        $this->notification_message = $message;
    }

    public function render()
    {
        $this->awards = Award::withCount(['contestants', 'votes'])->get();
        return view('livewire.award.table');
    }
}
