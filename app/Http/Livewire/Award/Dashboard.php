<?php

namespace App\Http\Livewire\Award;

use Livewire\Component;
use App\Models\AcademicSession;
use App\Models\Contestant;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    protected $listeners = ['showNotification' => 'setNotificationMessage'];

    public $academic_sessions;
    public $academic_session;
    public $selected_academic_session_id;
    public $query;
    public $notification_message;
    public $showDeleteNotification = false;
    public $selected_record;

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

    public function showDeleteNotification(Contestant $record)
    {
        $this->showDeleteNotification = true;
        $this->selected_record = $record;
    }

    public function setNotificationMessage($message)
    {
        $this->notification_message = $message;
    }

    public function deleteRecord()
    {
        $this->selected_record->delete();
        $this->showDeleteNotification  = false;
        $this->notification_message = "Contestant has been removed successfully";
        $this->reset('selected_record');
    }

    public function getContestants()
    {
        return  Contestant::award()
                ->with([
                    'user:id,first_name,middle_name,last_name',
                    'contestantable:id,name as award'
                ])
                ->withCount('votes')
                ->where('academic_session_id', $this->academic_session->id)
                ->get()->sortByDesc('contestantable.name');
    }

    public function render()
    {
        return view('livewire.award.dashboard', [
            'contestants' => $this->getContestants()
        ])
        ->extends('layouts.app')
        ->section('content');
    }
}
