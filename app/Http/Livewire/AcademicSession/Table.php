<?php

namespace App\Http\Livewire\AcademicSession;

use App\Models\AcademicSession;
use Livewire\Component;

class Table extends Component
{
    protected $listeners = ['academic_session_created' => 'notify'];

    public $academic_sessions;
    public $notification_message;

    public function mount()
    {
    }

    public function notify($message)
    {
        $this->notification_message = $message;
        //$this->mount();
    }

    public function clearMessage()
    {
        //$this->notification_message = null;
    }

    public function render()
    {
        $this->academic_sessions = AcademicSession::withCount([
                                    'votes',
                                    'contestants',
                                    'academic_records'
                                    ])->get();
        return view('livewire.academic-session.table');
    }
}
