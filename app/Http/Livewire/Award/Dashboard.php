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
    public $selected_academic_session_id;
    public $query;
    public $notification_message;

    public function mount()
    {
        $this->academic_sessions = AcademicSession::all();
        $this->academic_session = cache()->get('current_academic_sessions');
    }

    public function updatedSelectedAcademicSessionId()
    {
        $this->academic_session = $this->academic_sessions->find($this->selected_academic_session_id);
    }

    public function clearMessage(){
        $this->reset('notification_message');
    }

    public function setNotificationMessage($message)
    {
        $this->notification_message = $message;
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
                ->when(!empty($this->search), function ($q) {
                    return $q->whereHas('user', function ($query) {
                        $query->where('users.first_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('users.middle_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('users.last_name', 'LIKE', "%{$this->search}%");
                    });
                })
                ->get()->sortByDesc('contestantable.name');
    }

    public function getWinners()
    {
        return  Contestant::award()->winners()->with([
                'user:id,first_name,middle_name,last_name',
                'contestantable:id,name as award'
                ])
                ->where('academic_session_id', $this->academic_session->id)
                ->get();
    }

    public function render()
    {
        return view('livewire.award.dashboard', [
            'contestants' => $this->getContestants(),
            'winners' => $this->getWinners()
        ])->extends('layouts.app')
        ->section('content');
    }
}
