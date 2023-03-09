<?php

namespace App\Http\Livewire\Office;

use App\Models\Award;
use Livewire\Component;
use App\Models\Ballot;
use App\Models\Office;
use App\Models\Semester;
use App\Models\Vote;

class WinnersList extends Component
{
    public $winners = [];
    public $semester;
    public $election_ongoing = false;

    public function mount()
    {
        $this->getCurrentWinners();
        $this->checkOnGoingElection();
    }

    public function getCurrentWinners()
    {

        $this->winners = Office::with([
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

    public function calActiveElectionResult(): void
    {
        Ballot::computeElectionResult('office');

        $this->getCurrentWinners();
        $this->election_ongoing = false;
    }

    protected function checkOnGoingElection(): void
    {
        if ($active_semester = Semester::active()) {
            $votes =  Vote::votesBySemesterId($active_semester->id, 'office')->count();

            $this->election_ongoing = ($votes > 0 && $active_semester->id != optional($this->semester)->id);
        }
    }

    public function render()
    {
        return view('livewire.office.winners-list');
    }
}
