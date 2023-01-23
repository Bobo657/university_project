<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;
use App\Models\AcademicSession;
use App\Models\Contestant;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    protected $listeners = ['showNotification' => 'setNotificationMessage'];

    public $academic_sessions;
    public $selected_academic_session_id;
    public $query;
    public $notification_message;
    public $academic_session;

    public function mount()
    {
        $this->academic_sessions = AcademicSession::all();
        $this->academic_session = cache()->get('current_academic_sessions');
    }

    public function updatedSelectedAcademicSessionId()
    {
        $this->academic_session = $this->academic_sessions->find($this->selected_academic_session_id);
        $this->emit('academic_session_changed', $this->academic_session->id);
    }

    public function clearMessage()
    {
        $this->reset('notification_message');
    }

    public function setNotificationMessage($message)
    {
        $this->notification_message = $message;
    }

    public function getContestants()
    {
        return  Contestant::office()
                ->with([
                    'user:id,first_name,middle_name,last_name',
                    'contestantable:id,name as office'
                ])
                ->withCount('votes')
                ->where('academic_session_id', $this->academic_session->id)
                ->get()->sortByDesc('contestantable.name');
    }

    public function render()
    {
        return view('livewire.office.dashboard', ['contestants' => $this->getContestants()])
        ->extends('layouts.app')
        ->section('content');
    }
}
