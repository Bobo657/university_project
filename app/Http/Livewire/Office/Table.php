<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;

class Table extends Component
{
    protected $listeners = ['new_office_created' => 'notify'];

    public $offices;
    public $notification_message;


    public function notify($message)
    {
        $this->notification_message = $message;
    }

    public function clearMessage()
    {
        //$this->notification_message = null;
    }

    public function render()
    {
        $this->offices = Office::withCount(['contestants', 'votes'])->get();

        return view('livewire.office.table');
    }
}
