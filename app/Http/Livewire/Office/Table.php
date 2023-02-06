<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;

class Table extends Component
{
    protected $listeners = [
        'new_office_created' => 'notify',
        'showNotification' => 'notify'
    ];

    public $offices;
    public $notification_message;
    public $showDeleteNotification;
    public $selected_record;

    public function showDeleteNotification(Office $office)
    {
        $this->showDeleteNotification = true;
        $this->selected_record = $office;
    }

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
