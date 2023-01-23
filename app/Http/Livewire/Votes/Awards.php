<?php

namespace App\Http\Livewire\Votes;

use App\Models\{Vote, AcademicSession};
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Awards extends Component
{
    use WithPagination;

    public $notification_message;
    public $academic_sessions;
    public $academic_session;
    public $selected_academic_session_id;
    public $showDeleteNotification = false;
    public $selected_record;
    public $search;
    public $no_of_records = 50;
    public $total_contestants;
    public $total_votes;

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

    public function showDeleteNotification(Vote $vote)
    {
        $this->showDeleteNotification = true;
        $this->selected_record = $vote;
    }

    public function deleteRecord()
    {
        $this->selected_record->delete();
        $this->showDeleteNotification  = false;
        $this->notification_message = "Student vote deleted successfully";
        $this->reset('selected_record', 'showDeleteNotification');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingNoOfRecords()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = DB::table('votes')
                ->select(
                    'votes.id',
                    'votes.created_at',
                    'acs.duration',
                    'voter.first_name',
                    'voter.last_name',
                    'voter.middle_name',
                    'awards.name',
                    'contestant.first_name as first',
                    'contestant.last_name as last',
                    'contestant.middle_name as middle'
                )
                ->leftJoin('academic_sessions as acs', 'acs.id', '=', 'votes.academic_session_id')
                ->leftJoin('users as voter', 'voter.id', '=', 'votes.user_id')
                ->leftJoin('contestants as con', 'con.id', '=', 'votes.contestant_id')
                ->leftJoin('awards', 'awards.id', '=', 'con.contestantable_id')
                ->leftJoin('users as contestant', 'contestant.id', '=', 'con.user_id')
                ->where('con.contestantable_type', 'award')
                ->where('votes.academic_session_id', $this->academic_session->id);

        $this->total_votes = $query->count();
        $this->total_contestants = $query->count(DB::raw('DISTINCT con.id'));

        $votes = $query->when(strlen($this->search) > 2, function ($q) {
            return $q->where('contestant.first_name', 'like', "%{$this->search}%")
                    ->orWhere('contestant.last_name', 'like', "%{$this->search}%")
                    ->orWhere('contestant.middle_name', 'like', "%{$this->search}%");
        })->paginate($this->no_of_records);

        return view('livewire.votes.awards', [
            'votes' => $votes
        ])
        ->extends('layouts.app')
        ->section('content');
    }
}
