<?php

namespace App\Http\Livewire\Vote;


use App\Models\Semester;
use App\Models\Vote;
use App\Traits\TableWithFilters;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VotersList extends Component
{
   
    use TableWithFilters;

    protected $listeners = ['removeSelectedVote' => 'deleteRecord'];
    protected $actions = ['action' => 'removeSelectedVote'];
    protected $resetProperties = ['contestant', 'voter', 'ballot'];

    public $recordId;
    public $voter = '';
    public $contestant = '';
    public $semesters = [];
    public $ballots = ['office', 'award'];
    public $semesterId;
    public $ballot = 'office';
    

    public function mount()
    {
        $this->semesters = Semester::select(['id', 'duration'])->get();
        $this->semesterId = cache('active_semester')->id;
    }

    public function deleteRecord()
    {
        $vote = Vote::findOrFail($this->recordId);
        $vote->delete();

        $this->dispatchBrowserEvent('display-notification', [
            'message' => 'Student vote has been deleted successfully'
        ]);

        $this->reset('recordId');
    }


    public function render()
    {
        return view('livewire.vote.voters-list', ['votes' => $this->getVotes()])
                ->extends('layouts.app')
                ->section('content');
    }

    protected function getVotes()
    {

        $query = Vote::query()
                    ->with([
                        'ballot' => function ($query) {
                            $query->select(['id', 'ballotable_type', 'ballotable_id'])
                            ->with('ballotable:id,name');
                        }
                    ])
                    ->where('semester_id', $this->semesterId)
                    ->when(!empty($this->contestant), function ($query) {
                        $query->whereHas('voteOwner', function ($query) {
                            $query->where(
                                DB::raw('concat(first_name, " ",middle_name," ",last_name)'), 
                                'LIKE', 
                                "%{$this->contestant}%"
                            );
                        });
                    })
                    ->when(!empty($this->voter), function ($query) {
                        $query->whereHas('voter', function ($query){
                            $query->where(
                                DB::raw('concat(first_name, " ",middle_name," ",last_name)'), 
                                'LIKE', 
                                "%{$this->voter}%"
                            );
                        });
                    })
                    ->when(!empty($this->ballot), function ($query) {
                        return $query->whereHas('ballot', fn ($query) => $query->where('ballotable_type', $this->ballot));
                    });


        return $query->paginate($this->noOfRecords);
    }

}



 