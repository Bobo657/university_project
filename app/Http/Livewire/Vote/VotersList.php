<?php

namespace App\Http\Livewire\Vote;

use App\Models\Ballot;
use App\Models\Semester;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;

class VotersList extends Component
{
    use WithPagination;

    protected $listeners = ['removeSelectedVote' => 'deleteRecord'];
    public $selected_record_id;
    public $voter;
    public $contestant;
    public $semesters;
    public $ballots = [];
    public $no_of_records = 20;
    public $semester = "";
    public $ballot;

    public function mount()
    {
        $this->semesters = Semester::select(['id', 'duration'])->get();
        $this->ballots = Ballot::distinct()->pluck('ballotable_type');
    }

    public function resetParameters()
    {
        $this->resetPage();
        $this->reset(['semester', 'voter', 'contestant', 'ballot']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingNoOfRecords()
    {
        $this->resetPage();
    }

    public function confirmDelete($record_id)
    {
        $this->selected_record_id = $record_id;
        $this->dispatchBrowserEvent('delete-notify', ['action' => 'removeSelectedVote']);
    }

    public function deleteRecord()
    {
        Vote::findOrFail($this->selected_record_id)->delete();
        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student vote has been delete successfully'
        ]);

        $this->reset('selected_record_id');
    }


    public function render()
    {
        $votes = Vote::with([
                    'semester:id,duration',
                    'ballot' => function ($query) {
                                $query->select(['id','ballotable_type','ballotable_id'])
                                      ->with('ballotable:id,name');
                    },
                    'voteOwner:users.id,first_name,last_name,middle_name,profile_photo_path,gender',
                    'voter:users.id,first_name,last_name,middle_name,profile_photo_path,gender'
                 ])->when(!empty($this->semester), function ($query) {
                    return $query->where('semester_id', $this->semester);
                 }) 
                 ->when(!empty($this->contestant), function ($q) {
                    return $q->whereHas('voteOwner', function ($query) {
                                $query->where('users.first_name', 'LIKE', "%{$this->contestant}%")
                                ->orWhere('users.middle_name', 'LIKE', "%{$this->contestant}%")
                                ->orWhere('users.last_name', 'LIKE', "%{$this->contestant}%");
                            });
                })->when(!empty($this->voter), function ($q) {
                    return $q->whereHas('voter', function ($query) {
                                $query->where('users.first_name', 'LIKE', "%{$this->voter}%")
                                ->orWhere('users.middle_name', 'LIKE', "%{$this->voter}%")
                                ->orWhere('users.last_name', 'LIKE', "%{$this->voter}%");
                            });
                })
                ->when(!empty($this->ballot), function ($q) {
                    return $q->whereHas('ballot', function ($query) {
                                $query->where('ballotable_type', $this->ballot);
                            });
                });
                  
        return view('livewire.vote.voters-list', [
            'votes' => $votes->paginate($this->no_of_records)
        ])
        ->extends('layouts.app')
        ->section('content');
    }
}
 