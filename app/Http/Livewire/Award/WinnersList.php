<?php

namespace App\Http\Livewire\Award;

use App\Models\Award;
use App\Models\Ballot;
use App\Models\Semester;
use App\Models\Vote;
use Livewire\Component;

class WinnersList extends Component
{
    public $winners = [];
    public $election_ongoing = false;
    public $semester;

    public function mount()
    {
        $this->getCurrentWinners();
        $this->checkOnGoingElection();
    }

    protected function getCurrentWinners()
    {

        $this->winners = Award::with([
                            'lastestWinner' =>  function ($query) {
                                                    $query->select(['user_id', 'id', 'ballots.ballotable_type', 'ballots.ballotable_id', 'semester_id'])
                                                    ->with([
                                                        'user:id,last_name,gender,first_name,middle_name',
                                                        'semester',
                                                    ]);
                                                }
                        ])
                        ->whereHas('lastestWinner')->get();
    }

    public function calActiveElectionResult()
    {
        Ballot::computeElectionResult('award');

        $this->getCurrentWinners();
        $this->election_ongoing = false;
    }

    protected function checkOnGoingElection(): void
    {
        if ($active_semester = Semester::active()) {
            $votes =  Vote::votesBySemesterId($active_semester->id, 'award')->count();
            $this->election_ongoing = ($votes > 0 && $active_semester->id != optional($this->semester)->id);
        }
    }

    public function render()
    {
        return view('livewire.award.winners-list');
    }
}
